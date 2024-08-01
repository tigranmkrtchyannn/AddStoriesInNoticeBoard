<!DOCTYPE html>
<html>
<head>
    @vite('resources/js/app.js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Notice Board</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            color: #333;
            margin-top: 20px;
        }

        #stories {
            width: 60%;
            margin: 20px auto;
        }

        .story {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .story h2 {
            margin: 0 0 10px;
            color: #007bff;
        }

        .story div {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .story small {
            color: #aaa;
            display: block;
            text-align: right;
        }
    </style>
</head>
<body>
<h1>Notice Board</h1>
<div id="stories">
    @foreach($approvedStories as $story)
        <div class="story" id="story-{{$story->id}}">
            <h2>{{$story->title}}</h2>
            <div>{{$story->description}}</div>
        </div>
    @endforeach
</div>

<script type="module">
    window.Echo.channel('noticeboard')
        .listen('StoryEvent', (e) => {
            document.getElementById("stories").prepend(
                                `<div class="story">
                                    <h2>${e.title}</h2>
                                    <div>${e.description}</div>
                                </div>`)
        });
</script>
</body>
</html>
