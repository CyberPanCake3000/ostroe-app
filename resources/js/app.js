import './bootstrap';
import * as bootstrap from 'bootstrap';
import 'jquery-validation';

import '../sass/app.scss';

import jQuery from 'jquery';

window.$ = jQuery;
$(document).ready(function () {

    updateDate();
    updateClock();
    setInterval(updateClock, 60000);

    function updateDate() {
        let today = new Date(), day = today.getDate(), month = today.getMonth(), weekday = today.getDay();
        let months = ["января", "февраля", "марта",
            "апреля", "мая", "июня",
            "июля", "августа", "сентября",
            "октября", "ноября", "декабря"];

        let weekdays = ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"];

        month = months[month];
        weekday = weekdays[weekday];

        let result = day + " " + month;

        $('.dateDiv').text(result);
        $('.dayDiv').text(weekday);
    }

    function updateClock() {
        let date = new Date(), hours = date.getHours(), minutes = date.getMinutes();

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }

        let time = hours + ":" + minutes;

        $(".timeDiv").text(time);
    }

    let addOrderForm = $('#addOrderForm');

    if (addOrderForm) {
        addOrderForm.validate({
            rules: {
                'name': 'required',
                'phone': {
                    required: 'required',
                },
            },
            messages: {
                'name': 'Это обязательное поле',
                'phone': 'Это обязательное поле',
            }
        });
    }

    $("input[type='tel']").on("keypress", function (event) {
        let key = event.charCode || event.keyCode || 0;
        return (key === 8 || key === 9 || key === 46 || (key >= 48 && key <= 57));
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let search = $('#search');

    if (search) {
        search.on('input', function (e) {
            let query = $(this).val();
            if (query.length >= 2) {
                $.ajax({
                    url: '/suggestions',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(results) {
                        $(".suggestions").empty();
                        $.each(results, function(index, result){
                            $(".suggestions").append("<option value='" + result.name + "'>" + result.name + ' ' + result.phone + "</option>");
                        });
                    }
                });
            }
        });
    }

    let phoneInput = $('#addOrderForm #phone');

    if(phoneInput){
        phoneInput.on('input', function() {
            var query = $(this).val();

            if ($('#phone_list option[value="' + query + '"]').length) {
                $.ajax({
                    url: '/customerSearch',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function (result) {
                        console.log(result);
                        $('.name').val(result.name);
                        $('.birth_date').val(result.birth_date);

                        $('.OD_Sph').val(result.OD_Sph);
                        $('.OD_Cyl').val(result.OD_Cyl);
                        $('.OD_ax').val(result.OD_ax);

                        $('.OS_Sph').val(result.OS_Sph);
                        $('.OS_Cyl').val(result.OS_Cyl);
                        $('.OS_ax').val(result.OS_ax);

                        $('.Dpp').val(result.Dpp);
                        $('.customer_comment').val(result.comment);
                        $('.phone').val(result.phone);
                    }
                });
            }


            if (query.length >= 2) {
                $.ajax({
                    url: '/customersSearch',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(results) {
                        $(".phone_list").empty();
                        $.each(results, function(index, result) {
                            $(".phone_list").append("<option value='" + result.id + "'>" + result.name + ' ' + result.phone + "</option>");
                        });
                    }
                });
            }
        });
    }
});
