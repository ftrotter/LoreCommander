<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Link {{ $durc_type_left }} {{$durc_type_right}}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/select2.min.css" rel="stylesheet" />

  </head>
  <body>

    <div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h2>
					Generate new links between {{$durc_type_left}} and {{$durc_type_right}}
				</h2>
				<p>
This interface allows you to quickly tag sets of objects...
				</p>
			</div>

		</div>
	</div>

<form method='POST' action='/genericLinkerSave/{{$durc_type_left}}/{{$durc_type_right}}/{{$durc_type_tag}}'>
	{{ csrf_field() }}

	<div class='row'>
		<div class='col-md-1'></div>
		<div class='col-md-3'>
			<h3> Select {{$durc_type_left}} </h3>

			<select class='{{$durc_type_left}}_id form-control' multiple='' id='{{$durc_type_left}}_id' name='{{$durc_type_left}}_id[]'>
			</select>

		</div>

		<div class='col-md-1'></div>
		<div class='col-md-2'>
			<h3> Tag {{$durc_type_tag}} </h3>

			<select class='{{$durc_type_tag}}_id form-control' multiple='' id='{{$durc_type_tag}}_id' name='{{$durc_type_tag}}_id[]'>
			</select>

		</div>
		<div class='col-md-1'></div>
		<div class='col-md-3'>
			<h3> Select {{$durc_type_right}} </h3>

			<select class='{{$durc_type_right}}_id form-control' multiple='' id='{{$durc_type_right}}_id' name='{{$durc_type_right}}_id[]'>
			</select>

		</div>
		<div class='col-md-1'></div>
	</div>

	<div class='row'>
		<div class='col-md-2'></div>
		<div class='col-md-10'>
 			<button name="submit" type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
	</form>

</div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/select2.min.js"></script>

<script type='text/javascript'>

$('.{{$durc_type_left}}_id').select2({
  ajax: {
    	url: '/DURC/searchjson/{{$durc_type_left}}/',
    	dataType: 'json'
  }
});

$('.{{$durc_type_right}}_id').select2({
  ajax: {
    	url: '/DURC/searchjson/{{$durc_type_right}}/',
    	dataType: 'json'
  }
});

$('.{{$durc_type_tag}}_id').select2({
  ajax: {
    	url: '/DURC/searchjson/{{$durc_type_tag}}/',
    	dataType: 'json'
  }
});

</script>
  </body>
</html>
