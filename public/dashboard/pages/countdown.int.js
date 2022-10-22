
/*
 Template Name: Drixo - Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Countdown init js
 */

$(document).ready(function() {

    // Countdown
        // To change date, simply edit: var endDate = "January 17, 2019 20:39:00";
        $(function() {
            // var endDate = (date("m-d-Y H:i:s", strtotime(decrypt_value(licence_verify()->expire)+' +10 days')));
            // var endDate = "09-08-2022 16:05:42";
            // var DateI = date_licence_expire_with_susis();
            var endDate = document.getElementById(variableAPasser).value;
            alert("endDate");

        $('.comming-watch .countdown').countdown({
            date: " ' " + endDate + " ' ",
            render: function(data) {
                $(this.el).html('<div><div class="card card-body p-3"><span class="countdown-num">' + (parseInt(this.leadingZeros(data.years, 2) * 365) + parseInt(this.leadingZeros(data.days, 2))) + '</span><span class="text-uppercase">days</span></div><div class="card card-body p-3"><span class="countdown-num">' + this.leadingZeros(data.hours, 2) + '</span><span class="text-uppercase">hours</span></div></div><div class="lj-countdown-ms "><div class="card card-body p-3"><span class="countdown-num">' + this.leadingZeros(data.min, 2) + '</span><span class="text-uppercase">minutes</span></div><div class="card card-body p-3"><span class="countdown-num">' + this.leadingZeros(data.sec, 2) + '</span><span class="text-uppercase">seconds</span></div></div>');
            }
        });

    });
});
