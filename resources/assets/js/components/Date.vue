<style>
	*,
	*:before,
	*:after {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}

	.clock {
		background: #fff;
		border: .3rem solid #fff;
		border-radius: .5rem;
		display: inline-block;
		box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.3);
	}

	.clock__hours,
	.clock__minutes,
	.date,
	.clock__seconds {
		background: linear-gradient(to bottom, #90c5ff 50%, #89b5ea 50%);
		display: inline-block;
		color: #fff;
		font-family: 'Nunito', sans-serif;
		font-size: 3rem;
		font-weight: 300;
		padding: .5rem 1rem;
		text-align: center;
		position: relative;
	}

	.date {
		display: block;
		margin-top: 2px;
		font-size: 2rem;
	}

	.clock__hours {
		border-right: .15rem solid #fff;
		border-radius: .5rem 0 0 .5rem;
	}

	.clock__minutes {
		border-right: .15rem solid #fff;
	}

	.clock__seconds {
		border-radius: 0 .5rem .5rem 0;
	}

	.clock__hourtime {
		font-size: 1rem;
		position: absolute;
		top: 2px;
		left: 8px;
	}
</style>

<template>
	<div class="clock">
		<div class="clock__hours"><span class="clock__hourtime">{{hourtime}}</span> {{hours}}</div>
		<div class="clock__minutes">{{minutes}}</div>
		<div class="clock__seconds">{{seconds}}</div>
		<div class="date">
			{{ date }}
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                hours: '',
                minutes: '',
                seconds: '',
                hourtime: '',
                date: ''
            };
        },

        mounted() {
            this.updateDateTime();
        },

        methods: {
            updateDateTime() {
                var self = this;
                var now = new Date();

                self.hours = now.getHours();
                self.minutes = self.getZeroPad(now.getMinutes());
                self.seconds = self.getZeroPad(now.getSeconds());
                self.hourtime = self.getHourTime(self.hours);
                self.hours = self.hours % 12 || 12;
                self.date = self.formatDate(now);

                setTimeout(self.updateDateTime, 1000);
            },
            getHourTime(h) {
                return h >= 12 ? 'PM' : 'AM';
            },
            getZeroPad(n) {
                return (parseInt(n, 10) >= 10 ? '' : '0') + n;
            },
            formatDate(date) {
                let monthNames = [
                    "January", "February", "March",
                    "April", "May", "June", "July",
                    "August", "September", "October",
                    "November", "December"
                ];

                let dayNames = [
                    "Sunday", "Monday", "Tuesday",
                    "Wednesday", "Thursday", "Friday", "Saturday"
                ];

                let da = date.getDate();
                let monthIndex = date.getMonth();
                let year = date.getFullYear();
                let day = date.getDay();

                return `${dayNames[day]}, ${monthNames[monthIndex]} ${da} ${year}`;
            }
        }
    };
</script>