<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/bootstrap.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/fontawesome-free-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
<!-- page specific plugin styles -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>posts/ajaxPaginationData/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {
            $('#postList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}
</script>
<body class="content">
<div class="container">
<br><br><br>
    <center><h1>Ajax Pagination with Search in CodeIgniter</h1></center>
    <br><br>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        <div class="post-search-panel">
            <input type="text" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()"/>
            <select id="sortBy" onchange="searchFilter()">
                <option value="">Sort By</option>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
        <div class="post-list" id="postList">
            <?php if(!empty($posts)): foreach($posts as $post): ?>
                <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $post['title']; ?></h2></a></div>
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
            <?php echo $this->ajax_pagination->create_links(); ?>
        </div>
        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div></div>
    </div>
    </div>
</div>
</body>