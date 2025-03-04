  let videoStream = null;
        let captureTimeout = null;
        let countdown = 2;
        let detecting = false;
        let detectionInterval = null;

        const video = document.getElementById('video');
        const canvas = document.getElementById('overlay');
        const timerDisplay = document.getElementById('timer');
        const toggleCameraBtn = document.getElementById('toggleCameraBtn');
        const imageFileInput = document.getElementById('imageFile');
        const preview = document.getElementById('preview');
        canvas.style.background = 'black';

        // Start webcam
        async function startVideo() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {}
                });
                videoStream = stream;
                video.srcObject = videoStream;
                video.style.display = 'block';
                canvas.style.background = 'none';

                video.onloadedmetadata = () => {
                    adjustOverlaySize();
                    detectFace();
                };

                detecting = true;
                toggleCameraBtn.textContent = 'Turn Off Camera';
            } catch (error) {
                console.error('Error accessing webcam:', error);
                if (error.name === 'NotAllowedError') {
                    alert('Camera access was denied. Please allow camera access in your browser settings.');
                } else if (error.name === 'NotFoundError') {
                    alert('No camera found. Please ensure your device has a camera.');
                } else {
                    alert('Unable to access the camera. Please check permissions.');
                }
            }
        }

        // Stop webcam
        function stopVideo() {
            if (videoStream) {
                const tracks = videoStream.getTracks();
                tracks.forEach(track => track.stop());
            }
            videoStream = null;
            detecting = false;
            video.style.display = 'none'; // Hide the video element when camera is off
            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height); // Clear the overlay canvas
            canvas.style.background = 'black';

            // Stop detection and countdown
            if (detectionInterval) {
                clearInterval(detectionInterval);
                detectionInterval = null;
            }

            if (captureTimeout) {
                clearInterval(captureTimeout);
                captureTimeout = null;
            }

            resetCountdown();
            toggleCameraBtn.textContent = 'Turn On Camera';
        }

        // Toggle camera on/off
        toggleCameraBtn.addEventListener('click', () => {
            if (detecting) {
                stopVideo();
            } else {
                startVideo();
            }
        });

        // Load face-api models
        async function loadModels() {
            try {
                await faceapi.nets.tinyFaceDetector.loadFromUri('/lib/face-api.js/weights');
                await faceapi.nets.faceLandmark68Net.loadFromUri('/lib/face-api.js/weights');
                await faceapi.nets.faceRecognitionNet.loadFromUri('/lib/face-api.js/weights');
            } catch (error) {
                console.error('Error loading face-api models:', error);
            }
        }

        // Function to adjust overlay canvas size to match the video size
        function adjustOverlaySize() {
            const videoDisplaySize = video.getBoundingClientRect(); // Get actual displayed size of the video
            canvas.width = videoDisplaySize.width;
            canvas.height = videoDisplaySize.height;
            faceapi.matchDimensions(canvas, videoDisplaySize); // Match canvas to video size
        }

        // Detect faces and draw detection box
        async function detectFace() {
            const displaySize = {
                width: video.clientWidth,
                height: video.clientHeight
            };
            faceapi.matchDimensions(canvas, displaySize);

            // Ensure no existing interval is running
            if (detectionInterval) {
                clearInterval(detectionInterval);
                detectionInterval = null;
            }

            detectionInterval = setInterval(async () => {
                if (!detecting) {
                    clearInterval(detectionInterval);
                    detectionInterval = null;
                    return;
                }

                try {
                    const options = new faceapi.TinyFaceDetectorOptions({
                        inputSize: 512,
                        scoreThreshold: 0.5
                    });
                    const detections = await faceapi.detectAllFaces(video, options);

                    // Post-Await Check
                    if (!detecting) {
                        return;
                    }

                    const resizedDetections = faceapi.resizeResults(detections, displaySize);
                    const ctx = canvas.getContext('2d');
                    if (ctx) {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                    }

                    if (resizedDetections.length > 0) {
                        faceapi.draw.drawDetections(canvas, resizedDetections);
                        startCountdown(); // Start the timer when face is detected
                    } else {
                        resetCountdown();
                    }
                } catch (error) {
                    console.error('Error during face detection:', error);
                }
            }, 100); // Check every 100ms
        }

        // Start countdown timer for capture
        function startCountdown() {
            if (captureTimeout === null) {
                timerDisplay.style.display = 'block'; // Show timer only when starting capture
                countdown = 2;
                timerDisplay.textContent = `Timer: ${countdown}`;

                captureTimeout = setInterval(() => {
                    countdown--;
                    timerDisplay.textContent = `Timer: ${countdown}`;

                    if (countdown <= 0) {
                        captureImage();
                        resetCountdown();
                    }
                }, 1000); // Countdown every second
            }
        }

        // Reset countdown timer
        function resetCountdown() {
            if (captureTimeout) {
                clearInterval(captureTimeout);
                captureTimeout = null;
            }
            countdown = 2;
            timerDisplay.textContent = `Timer: ${countdown}`;
            timerDisplay.style.display = 'none'; // Hide timer when not capturing
        }

        // Capture image from video
        function captureImage() {
            const context = canvas.getContext('2d');
            if (context) {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
            }
            const imageData = canvas.toDataURL('image/png');

            const modalPreviewImg = document.getElementById('reviewUserImage');
            if (modalPreviewImg) {
                modalPreviewImg.src = imageData;
            }

            // Set captured image in input file
            const file = dataURLtoFile(imageData, 'captured.png');
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            imageFileInput.files = dataTransfer.files;

            // Update the preview
            const img = document.createElement('img');
            img.src = imageData;
            img.width = 300;
            img.height = 250; // Set image preview size
            preview.innerHTML = ''; // Clear previous previews
            preview.appendChild(img);

            stopVideo(); // Turn off the camera after capturing the image
        }

        // Convert base64 to file object
        function dataURLtoFile(dataurl, filename) {
            const arr = dataurl.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, {
                type: mime
            });
        }

        loadModels();