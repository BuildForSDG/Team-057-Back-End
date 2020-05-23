<?php 
    include 'app/info.php';

    $nav = new Navigator();

    $nav->tt = 'Page Not Found';
    $nav->page_tt = $nav->tt . ' | ' . $app_name;

    $nav->nav = [
        "Page Title" => $nav->page_tt,
        "Nav Title" => $nav->tt,
    ];

    $nav->change();

	startLayout('app'); 

?>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
                <div>
                    <h1 style="text-align: center; font-size: 10em; font-weight: 900; color: #222222;">404</h1> 
                    <hr style="border-color: #D10024; border-style: solid; border-width: 0.2em; border-radius: 5em; width: 30%; margin: auto;">
                    <br>
                    <p style="text-align: center; font-size: 4em; font-weight: 200; color: #666666;">Sorry, the page you are looking for could not be found.</p>
                    <br>
                    <div style="text-align: center;">
                        <a class="primary-btn" href="home">Go Home</a>
                    </div>
                </div>
			</div>
			<!-- /container -->
		</div>
        <!-- /SECTION -->
        

<?php endLayout('app') ?>