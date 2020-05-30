<?php
    dbCreate('users', [
        name('id').intg().null(false).autoInc(),
        name('User ID').text().null(false),
        name('First Name').text().null(false),
        name('Last Name').text().null(false),
        name('Gender').text().null(false),
        name('Email').text().null(false),
        name('Email Verified At').text().null(true),
        name('Phone').text().null(false),
        name('Date of Birth').text().null(false),
        name('Home Address').text().null(false),
        name('Password').text().null(false),
        name('Remeber Token').text().null(true),
        name('Updated At').timestamp().null(true),
        name('Created At').timestamp().null(false).def('CURRENT_TIMESTAMP')
    ]);
?>