<!DOCTYPE>
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
			.titile a{
				
			}
			.title a:link,
			.title a:visited,
			.title a:hover,
			.title a:active{
				TEXT-DECORATION:none;
				color: #8d66b1;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">
					<a href="/home" >玄天剑宗</a>
				</div>
				<div class="quote">{{ Inspiring::quote()}}</div>
			</div>
		</div>
	</body>
</html>
