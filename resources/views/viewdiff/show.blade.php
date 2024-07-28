<!DOCTYPE html>
<html lang=en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Two Texts Side by Side</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1/themes/prism-okaidia.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1/plugins/line-numbers/prism-line-numbers.min.css" />

    <style type="text/css">
        html {
            font-size: 13px;
        }
        .token.coord {
            color: #6cf;
        }
        .token.diff.bold {
            color: #fb0;
            font-weight: normal;
        }

	{!! $diff_stylesheet !!}

    </style>


</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
<ul>
	<li>
similar_text = {{ $similar_text_score }}
	</li>
	<li>

	</li>
	<li>

	</li>
	<li>

	</li>


</ul>
	
	</div>
    </div>
<br><br>
    <div class="row">
        <div class="col-md-12">
{!! $diff_html !!}
        </div>
    </div>

<br><br>
    <div class="row">
        <div class="col-md-6">
{!! $left_text !!}
        </div>
        <div class="col-md-6">
{!! $right_text !!}
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
