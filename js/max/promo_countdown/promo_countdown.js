// Drives the "video launching in" countdown on the promo page (EN + FR —
// both templates render the same .PromoVideoCountdown markup, just with
// translated labels, so one script covers both). Reads the target datetime
// from data-countdown-target (an ISO string in UTC) rather than hardcoding
// it here, so the template stays the single source of truth for the date.
document.addEventListener('DOMContentLoaded', function () {

    var countdowns = document.querySelectorAll('.PromoVideoCountdown');

    countdowns.forEach(function (el) {
        var target = new Date(el.getAttribute('data-countdown-target')).getTime();

        if (isNaN(target)) {
            return;
        }

        var daysEl = el.querySelector('[data-unit="days"]');
        var hoursEl = el.querySelector('[data-unit="hours"]');
        var minutesEl = el.querySelector('[data-unit="minutes"]');
        var secondsEl = el.querySelector('[data-unit="seconds"]');
        var timer = null;

        function pad( n ) {
            return n < 10 ? '0' + n : String( n );
        }

        function tick() {
            var diff = target - Date.now();

            if ( diff <= 0 ) {
                daysEl.textContent = '00';
                hoursEl.textContent = '00';
                minutesEl.textContent = '00';
                secondsEl.textContent = '00';
                clearInterval( timer );
                return;
            }

            var days = Math.floor( diff / 86400000 );
            var hours = Math.floor( ( diff % 86400000 ) / 3600000 );
            var minutes = Math.floor( ( diff % 3600000 ) / 60000 );
            var seconds = Math.floor( ( diff % 60000 ) / 1000 );

            daysEl.textContent = pad( days );
            hoursEl.textContent = pad( hours );
            minutesEl.textContent = pad( minutes );
            secondsEl.textContent = pad( seconds );
        }

        tick();
        timer = setInterval( tick, 1000 );
    });

});
