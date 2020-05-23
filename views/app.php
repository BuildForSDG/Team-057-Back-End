<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Covid 19 Estimator">
    <meta name="keywords" content="Covid,Corona,Virus,Covid-19,Estimate,Estimator">
    <meta name="author" content="Victor Momoh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid - 19 Estimator</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php assets('css/main.min.css') ?>">
</head>
<body>
    <aside class="">
        <div class="form">
            <div>
                <div class="head">
                    <h1 class="text-center">Welcome to Covid - 19 Estimator 2020</h1>
                    <h4 class="text-center sub-title">Fill in the fields below</h4>
                </div>
                <div class="row gg-2">
                    <div class="col-6">
                        <div class="input">
                            <label for="region">Region's Name</label>
                            <input type="text" name="region" id="region" data-region="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input">
                            <label for="avg-age">Avg. Age</label>
                            <input type="number" name="avg-age" id="avg-age" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input focus">
                            <label for="avg-daily-income">Avg. Daily Income In USD</label>
                            <input type="number" name="avg-daily-income" id="avg-daily-income" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input">
                            <label for="avg-daily-population">Avg. Daily Income Population</label>
                            <input type="number" name="avg-daily-population" id="avg-daily-population" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input">
                            <label for="time-to-elapse">Time To Elapse</label>
                            <input type="number" name="time-to-elapse" id="time-to-elapse" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input btn-select">
                            <label for="period-type">Period Type</label>
                            <input type="text" name="period-type" id="period-type" data-population="" maxlength="15">
                            <div>
                                <button class="selected">Days</button>
                                <button>Weeks</button>
                                <button>Months</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input">
                            <label for="reported-cases">Reported Cases</label>
                            <input type="number" name="reported-cases" id="reported-cases" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input">
                            <label for="population">Population</label>
                            <input type="number" name="population" id="population" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input">
                            <label for="hospital-beds">Total Hospital Beds</label>
                            <input type="number" name="hospital-beds" id="hospital-beds" data-population="" maxlength="15">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button id="goEstimate" aria-label="estimate" data-go-estimate=""><img class="icon" src="<?php assets('img/svgs/arrow-right.svg') ?>" alt="Estimate"></button>
                        <button id="loading" aria-label="loading"><div class="loader"></div></button>
                        <button id="check" aria-label="check" class="green"><img class="icon" src="<?php assets('img/svgs/check.svg') ?>" alt="Check"></button>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <nav class="hidden">
        <div class="header">
            <h1>Estimator Results</h1>
        </div>
    </nav>

    <main class="hidden">
        <div>
            <div class="card">
                <br>
                <br>
                <br>
                <h1>Hello</h1>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </main>

    <!-- <script src="<?php assets('js/main.js') ?>"></script> -->

</body>
</html>