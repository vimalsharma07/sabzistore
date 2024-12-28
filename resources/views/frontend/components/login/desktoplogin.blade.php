<style>
    
    .modal-content {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }
    .modal-header {
        border-bottom: none;
    }
    .modal-body {
        text-align: center;
    }
    .modal-footer {
        border-top: none;
    }
    .form-control {
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        margin-bottom: 1rem;
    }
    .btn {
        background-color: #28a745;
        color: #ffffff;
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        width: 100%;
    }
    .btn:hover {
        background-color: #218838;
    }
    .otp-input {
        width: 50px;
        height: 50px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        text-align: center;
        font-size: 24px;
        margin: 0 5px;
    }
    .resend-code {
        color: #6c757d;
        margin-top: 20px;
    }
    #otpModalLabel{
        margin-left: 27%;
    }

</style>
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="mobileInputSection">
                    <h5>India's last minute app</h5>
                    <p>Log in or Sign up</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">+91</span>
                        <input type="text" class="form-control" id="mobileNumber" placeholder="9999999999" aria-label="Mobile Number">
                    </div>
                    <button class="btn" id="sendOtpButton">Send OTP</button>
                    <p class="terms mt-3">
                        By continuing, you agree to our
                        <a href="#">Terms of service</a>
                        &amp;
                        <a href="#">Privacy policy</a>
                    </p>
                </div>

                <div id="otpInputSection" style="display: none;">
                    <p>We have sent a verification code to</p>
                    <h5 id="displayedMobileNumber">+91-9999999999</h5>
                    <div class="d-flex justify-content-center my-4">
                        <input type="text" class="otp-input" maxlength="1">
                        <input type="text" class="otp-input" maxlength="1">
                        <input type="text" class="otp-input" maxlength="1">
                        <input type="text" class="otp-input" maxlength="1">
                    </div>
                    <p class="resend-code">Resend Code (in 25 secs)</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('sendOtpButton').addEventListener('click', function () {
        const mobileNumber = document.getElementById('mobileNumber').value;
        if (mobileNumber && mobileNumber.length === 10) {
            // Simulate API call to send OTP
            console.log('Sending OTP to: ', mobileNumber);

            // Display OTP input section with animation
            document.getElementById('mobileInputSection').style.display = 'none';
            document.getElementById('otpInputSection').style.display = 'block';
            document.getElementById('displayedMobileNumber').textContent = `+91-${mobileNumber}`;
        } else {
            alert('Please enter a valid 10-digit mobile number.');
        }
    });
</script>
