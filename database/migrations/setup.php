<?php
    dbCreate('users', [
        name('id').intg().null(false).autoInc(),
        name('User ID').text().null(false),
        name('First Name').text().null(false),
        name('Last Name').text().null(false),
        name('Gender').text().null(false),
        name('Date of Birth').text().null(false),
        name('Email').text().null(false),
        name('Email Verified At').text().null(true),
        name('Phone').text().null(false),
        name('Country').text().null(false),
        name('State').text().null(false),
        name('City').text().null(false),
        name('Home Address').text().null(false),
        name('Remeber Token').text().null(true),
        name('Updated At').timestamp().null(true),
        name('Created At').timestamp().null(false).def('CURRENT_TIMESTAMP')
    ]);

    dbCreate('user_profiles', [
        name('id').intg().null(false).autoInc(),
        name('User ID').text().null(false),
        name('Profile Data').json().null(true),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);

    dbCreate('email_verifications', [
        name('id').intg().null(false).autoInc(),
        name('Email').text().null(false),
        name('OTP').text().null(false),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);

    dbCreate('regular_routes', [
        name('id').intg().null(false).autoInc(),
        name('Route ID').text().null(false),
        name('Start').json().null(false),
        name('Stop').json().null(true),
        name('Route Data').json().null(true),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);

    dbCreate('road_tips', [
        name('id').intg().null(false).autoInc(),
        name('Tip ID').text().null(false),
        name('Title').text().null(false),
        name('Content').text().null(false),
        name('Illustration').text().null(true),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);

    dbCreate('distress_broadcasts', [
        name('id').intg().null(false).autoInc(),
        name('Distress ID').text().null(false),
        name('Location').json().null(false),
        name('Data').json().null(true),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);

    dbCreate('poor_road_reports', [
        name('id').intg().null(false).autoInc(),
        name('Report ID').text().null(false),
        name('Location').json().null(false),
        name('Damage Ratio').text().null(true),
        name('Pictures').text().null(true),
        name('Data').text().null(false),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);

    dbCreate('rouge_driver_reports', [
        name('id').intg().null(false).autoInc(),
        name('Report ID').text().null(false),
        name('Location').json().null(false),
        name('Pictures').json().null(true),
        name('Medias').json().null(true),
        name('Data').json().null(false),
        name('Created At').timestamp().null(false).def(['CURRENT_TIMESTAMP'])
    ]);
?>