<!DOCTYPE html>
<html>
<head>
    <title>Story Approval</title>
</head>
<body>
<p>A new story has been submitted and is awaiting your approval.</p>
<p>Title: {{ $story->title }}</p>
<p>Description: {!! $story->description !!}</p>
<p>To approve this story, click the following link: <a href="{{ $approvalLink }}">Approve Story</a></p>
</body>
</html>
