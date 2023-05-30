<!DOCTYPE html>
<html lang="en">
<?php
    phpinfo();
?>
<!DOCTYPE html>
<html lang="bg" class="overflow-x-hidden">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="../images/title.png" />
    <link rel="stylesheet" href="../css/app.css" />

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Администраторски панел</title>
    <style>
        .calendar-row {
            justify-content: flex-end;
        }

        .calendar-row:last-child {
            justify-content: flex-start;
        }
    </style>
</head>

<body>
    <div id="calendar-head" class="w-[35.1rem] flex ">

    </div>
    <div id="date-selector" class="w-[35.1rem]"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

    <script>
        $(document).ready(function() {

            var selectedDates = [];
            var daysOfWeek = ["Пон", "Вто", "Сря", "Чет", "Пет", "Съб", "Нед"];
            for (var i = 0; i < daysOfWeek.length; i++) {
                $('#calendar-head').append("<div class='p-1.5 w-20 h-10 border'>" + daysOfWeek[i] + "</div>")
            }
            var currentDate = new Date();
            var nextMonth = currentDate.getMonth() + 2;
            var daysInNextMonth = new Date(currentDate.getFullYear(), nextMonth, 0).getDate();
            var firstDayOfNextMonth = new Date(currentDate.getFullYear(), nextMonth, 0).getDay();

            var dateBoxIndex = firstDayOfNextMonth;
            for (var i = 1; i <= daysInNextMonth; i++) {
                if (i == 1) {
                    $("#date-selector").append("<div class='calendar-row flex w-full'></div>");
                }
                if (dateBoxIndex === 0) {
                    $("#date-selector").append("<div class='calendar-row flex w-full'></div>");
                }
                var dateBox = $(`<div class='p-1.5 w-20 h-20 border cursor-pointer transition-all date-box js-date' data-date=${i}>` + i + "</div>");
                $(".calendar-row:last").append(dateBox);
                dateBoxIndex++;
                if (dateBoxIndex > 6) {
                    dateBoxIndex = 0;
                }
            }
        });

        ;
        (() => {

            const postData = async (url, data) => {                
                const fData = new FormData();
                for (const key in data) {
                    if (!data.hasOwnProperty(key)) {
                        continue;
                    }

                    if (key.endsWith("[]")) {
                        fData.append(`${key}[]`, data[key]);
                    } else {
                        fData.append(`${key}`, data[key]);
                    }
                }

                fetch(url, {
                    method: 'POST',
                    'body': fData
                });

            }

            const calendarDates = document.querySelectorAll(".js-date");
            console.log(calendarDates);
            for (const date of calendarDates) {
                date.addEventListener("click", toggleDate);
            }

            function toggleDate(e) {
                const trigger = e.currentTarger;
                const selectedDates = [];           
                trigger.classList.toggle("js-active-date");

                const activeDateEls = document.querySelectorAll(".js-active-date");
                
                for(const el of activeDateEls) {
                    const feed = {
                        date: el.dataset.date
                    }
                    selectedDates.push(feed);
                }

                alert('da');

                postData("./testAction.php", selectedDates);

            }

         

        })();
    </script>
</body>

</html>