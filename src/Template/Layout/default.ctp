<!DOCTYPE html>
<html>
<head>
	<title>Example</title>
</head>
<body>
    {$this->Flash->render()}
    <div class="container clearfix">
        {$this->fetch('content')}
    </div>
    <footer>
    </footer>
</body>
</html>