<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>delegate demo</title>
  <style>
  p 
  {
    background: silver;
    font-weight: lighter;
    cursor: crosshair;
    padding: 5px;
  }
  p.over 
  {
    background: violet;
  }
  span 
  {
    color: navy;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 
<p>Click me!</p>
 
<span></span>
 
<script>
$( "body" ).delegate( "p", "click", function() {
  $( this ).after( "<p>Another paragraph!</p>" ).css("font-weight", "bolder");
});
</script>
 
</body>
</html>