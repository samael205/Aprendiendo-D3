<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="./css/bootstrap-reboot.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/d3.min.js"></script>
	<script type="text/javascript" src="./js/code.js"></script>
	<script>

	</script>
	
	<title>Data Driven Documents</title>
	<style>
	.bar{
		fill: red;
	}
	</style>
</head>
<body>
	<span id="ejemplo"></span>
	<svg width="980" height="600"></svg>

	<script>
		var svg = d3.select("svg"),
		    margin = {top: 20, right: 20, bottom: 30, left: 40},
		    width = +svg.attr("width") - margin.left - margin.right,
		    height = +svg.attr("height") - margin.top - margin.bottom;
		var x = d3.scaleBand().rangeRound([0, width]).padding(0.5),
		    y = d3.scaleLinear().rangeRound([height, 0]);
		    d3.tsv("data1.tsv", function(d) {
		    	d.b = +d.b;
		    	return d;
		    }, function(error, data){
		    	if(error) throw error;
		    	x.domain(data.map(function(d){return d.a;}));
		    	y.domain([0, d3.max(data, function(d){return d.b;})]);
		    	g.append("g")
		    		.attr("class", "axis axis--x")
		    		.attr("transform", "translate(0," + height + ")")
		    		.call(d3.axisBottom(x));
		    	g.append("g")
		    		.attr("class", "axis axis--y")
		    		.call(d3.axisLeft(y).ticks(20, ""))
		    	.append("text")
		    		.attr("transform", "rotate(-90)")
		    		.attr("y", 6)
		    		.attr("dy", "0.71em")
		    		.attr("text-anchor", "end")
		    	.text("Frecuencia")
		    	g.selectAll(".bar")
		    	.data(data)
		    	.enter().append("rect")
		    	.attr("class", "bar")
		    	.attr("x", function(d){return x(d.a);})
		    	.attr("y", function(d){return y(d.b);})
		    	.attr("width", x.bandwidth())
		    	.attr("height", function(d){return height -y(d.b);})
		    })

		var g = svg.append("g").attr("transform", "translate("+margin.left +"," + margin.top + ")");
	</script>
</body>
</html>