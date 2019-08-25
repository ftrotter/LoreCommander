<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Need new Linker Table</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>

    <div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h2>
					New Linking
				</h2>
				<p>
This URL will representing a new linking table in your DURC instance. If that is on-purpose, then create the needed underlying table using the SQL below.
<br>
If not, (if this was a mistake) you should correct your URL above.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Learn more</a>
				</p>
			</div>
<pre>{{{ $create_table_sql}}}
</pre>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
