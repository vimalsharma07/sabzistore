$(document).ready(function () {
    let timer = 90;
    let otpTimer;

    // Function to start countdown timer
    function startTimer() {
        otpTimer = setInterval(function () {
            $('#timer').text(timer);
            if (timer <= 0) {
                clearInterval(otpTimer);
                $('#resendCode').text('Resend Code');
                $('#resendCode').off('click').on('click', resendOtp);
            }
            timer--;
        }, 1000);
    }

    // Send OTP
    $('#sendOtpButton').click(function () {
        const mobileNumber = $('#mobileNumber').val();
        if (mobileNumber && mobileNumber.length === 10) {
            // Send OTP to the backend
            $.post('/send-otp', { mobile_number: mobileNumber }, function (response) {
                if (response.message === 'OTP sent successfully.') {
                    alert(response.otp);
                    $('#mobileInputSection').hide();
                    $('#otpInputSection').show();
                    $('#displayedMobileNumber').text('+91-' + mobileNumber);
                    startTimer();
                } else {
                    alert(response.message);
                }
            });
        } else {
            alert('Please enter a valid 10-digit mobile number.');
        }
    });

    // Handle OTP input
    $('.otp-input').on('input', function () {
    const inputs = $('.otp-input');
    let otp = '';
    inputs.each(function () {
        otp += $(this).val();
    });

    // Move focus to the next input field when the current one is filled
    const currentInput = $(this);
    if (currentInput.val().length === 1) {
        currentInput.next('.otp-input').focus();
    }

    if (otp.length === 4) {
        validateOtp(otp);
    }
});

    // Validate OTP
    function validateOtp(otp) {
const mobileNumber = $('#mobileNumber').val();

$.ajax({
    url: '/validate-otp',
    type: 'POST',
    data: { mobile_number: mobileNumber, otp: otp },
    success: function (response) {
        if (response.message === 'OTP validated successfully.') {
            location.reload();
            $('#otpModal').modal('hide');
        } else {
            alert('Error: ' + response.message);
        }
    },
    error: function (xhr, status, error) {
        // Check for 500 server error and handle
        console.log(xhr.responseText);
        if (xhr.status === 500) {
            alert('Internal Server Error. Please try again later.');
        } else {
            // Log the error message and response for debugging
            console.error('Error Status: ' + status);
            console.error('Error Message: ' + error);
            console.error('Response Text: ' + xhr.responseText);
            alert('An error occurred. Please try again.');
        }
    }
});
}


    // Resend OTP (after countdown expires)
    function resendOtp() {
        const mobileNumber = $('#mobileNumber').val();
        $.post('/send-otp', { mobile_number: mobileNumber }, function (response) {
            if (response.message === 'OTP sent successfully.') {
                $('#resendCode').text('Resend Code (in 90 secs)');
                timer = 90;
                startTimer();
            } else {
                alert(response.message);
            }
        });
    }
});