<?php
    include 'layouts/header.php';
?>

<head>
    <style>
        .star-inactive {
            color: #cfd8dc;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
    <div class="container">
        <h5>Leave a Review</h5>
        <form action="">
            <div class="form-group">
                <label for="">Rate Your Experience</label>
                <div class="container bg-dark mt-5 p-5">
                    <span class="fa fa-star" data-index="1"></span>
                    <span class="fa fa-star" data-index="2"></span>
                    <span class="fa fa-star" data-index="3"></span>
                    <span class="fa fa-star" data-index="4"></span>
                    <span class="fa fa-star" data-index="5"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="content">Write a Comment</label><br>
                <textarea name="content" id="body" cols="50" rows="10"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="post_comment" value="Post">
            </div>
        </form>
    </div>

<script>

    $(document).ready(function(){
        const star = $('.fa-star');
        let ratedIndex = -1;
        //console.log(star);
        resetColor();

        $(star).click(function(){
            ratedIndex =  parseInt($(this).data('index'));
            console.log(ratedIndex);
        })

        $(star).mouseover(function(){
            let current = parseInt($(this).data('index'));

            setStarColor(current);
        });

        $(star).mouseleave(function(){
            resetColor();

            if(ratedIndex != -1){
                setStarColor(ratedIndex);
            }
        });

        function resetColor(){
            $(star).css('color', '#ffffff');
        }

        function setStarColor(max){
            for(let i=0; i<max; i++){
                $(star[i]).css('color', 'yellow');
            }
        }
    });

</script>
<?php
    include 'layouts/footer.php';
?>

<p class="float-right" style="position: relative; top: -30px;">
    <span class="text-muted mr-3">4.0</span>
    <span class="fa fa-star star-active"></span>
    <span class="fa fa-star star-active"></span>
    <span class="fa fa-star star-active"></span>
    <span class="fa fa-star star-active"></span>
    <span class="fa fa-star star-inactive"></span>
</p>