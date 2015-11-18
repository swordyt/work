<html>
	<head>
		<title>玄天剑宗</title>
		<style>
			@font-face{
				font-family: caoShu;
				src: url('{{url("fonts/caoshu.TTF")}}'),
     				 url('{{url("fonts/caoshu.eof")}}'); /* IE9+ */
			}
			@font-face{
				font-family: caoShu;
				src: url('{{url("fonts/caoshu.TTF")}}'),
     				 url('{{url("fonts/caoshu.eof")}}'); /* IE9+ */
				font-weight:bold;
			}
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'caoShu';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">玄天剑宗</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
			</div>
		</div>
	</body>
</html>
