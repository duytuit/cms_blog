<section id="main">
    <div class="container">
        <div class="row">
            <div class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"> <?= trans("home"); ?></a></li>
                    <?php if (!empty($categoryArray['parentCategory'])) : ?>
                        <li class="breadcrumb-item"><a href="<?= generateCategoryUrl(null, $categoryArray['parentCategory']->slug); ?>"><?= esc($categoryArray['parentCategory']->name); ?></a></li>
                    <?php endif;
                    if (!empty($categoryArray['subcategory'])) : ?>
                        <li class="breadcrumb-item"><a href="<?= generateCategoryUrl($categoryArray['parentCategory']->slug, $categoryArray['subcategory']->slug); ?>"><?= esc($categoryArray['subcategory']->name); ?></a></li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active"><?= esc($post->title); ?></li>
                </ol>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="content">
                    <div class="post-content">
                        <div class="post-title">
                            <h1 class="title"><?= esc($post->title); ?></h1>
                        </div>
                        <?php if (!empty($post->summary)) : ?>
                            <div class="post-summary">
                                <h2><?= $post->summary; ?></h2>
                            </div>
                        <?php endif; ?>
                        <?php if (generateToc($post->content)) : ?>
                            <div class='layout_toc'>
                                <div class='toc_title'>Mục lục</div>
                                <div class='toc_content' id="toc">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="post-meta">
                            <?php if (!empty($category) && !empty($category->parent_id)) :
                                $parent = getCategory($category->parent_id);
                                if (!empty($parent)) : ?>
                                    <a href="<?= generateCategoryUrl($parent->slug, $category->slug); ?>" class="font-weight-normal"><i class="icon-folder"></i>&nbsp;&nbsp;<?= esc($category->name); ?></a>
                                <?php endif;
                            else : ?>
                                <a href="<?= generateCategoryUrl(null, $category->slug); ?>" class="font-weight-normal">
                                    <i class="icon-folder"></i>&nbsp;&nbsp;<?= esc($category->name); ?>
                                </a>
                            <?php endif; ?>
                            <span><i class="icon-clock"></i>&nbsp;&nbsp;<?= dateFormatDefault($post->created_at); ?></span>
                            <?php if ($generalSettings->comment_system == 1) : ?>
                                <span><i class="icon-comment"></i>&nbsp;&nbsp;<?= getPostCommentCount($post->id); ?> </span>
                            <?php endif; ?>
                            <?php if ($generalSettings->show_pageviews == 1) : ?>
                                <span><i class="icon-eye"></i>&nbsp;&nbsp;<?= $post->hit; ?></span>
                            <?php endif;
                            if (authCheck()) : ?>
                                <form action="<?= base_url('add-remove-reading-list-post'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="post_id" value="<?= $post->id; ?>">
                                    <?php if ($is_reading_list == false) : ?>
                                        <button type="submit" class="add-to-reading-list pull-right"><i class="icon-plus-circle"></i>&nbsp;<?= trans("add_reading_list"); ?></button>
                                    <?php else : ?>
                                        <button type="submit" class="delete-from-reading-list  pull-right"><i class="icon-negative-circle"></i>&nbsp;<?= trans("delete_reading_list"); ?></button>
                                    <?php endif; ?>
                                </form>
                            <?php else : ?>
                                <a href="<?= langBaseUrl('login'); ?>" class="add-to-reading-list pull-right">
                                    <i class="icon-plus-circle"></i>&nbsp;<?= trans("add_reading_list"); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($post->video_embed_code)) : ?>
                            <div class="post-video">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?= $post->video_embed_code; ?>" allowfullscreen></iframe>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="post-image">
                                <?php if (!empty($additionalImages)) :
                                    echo view("post/_post_details_slider", ["adSpace" => "post_top"]);
                                else :
                                    if (!empty($post->image_url)) : ?>
                                        <img src="<?= $post->image_url; ?>" class="img-responsive center-image" alt="<?= esc($post->title); ?>" />
                                        <?php else :
                                        if (!empty($post->image_big)) : ?>
                                            <img src="<?= getPostImage($post, 'big'); ?>" class="img-responsive center-image" alt="<?= esc($post->title); ?>" />
                                    <?php endif;
                                    endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?= view("partials/_ad_spaces", ["adSpace" => "post_top"]); ?>

                        <div class="post-text text-style">
                            <?= $post->content;
                            if (!empty($post->optional_url)) : ?>
                                <div class="optional-url-cnt">
                                    <a href="<?= esc($post->optional_url); ?>" class="btn btn-md btn-custom" target="_blank" rel="nofollow">
                                        <?= esc($settings->optional_url_button_name); ?>&nbsp;&nbsp;&nbsp;<i class="icon-long-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post->post_url) && !empty($post->show_post_url)) : ?>
                                <div class="optional-url-cnt">
                                    <a href="<?= $post->post_url; ?>" class="btn btn-md btn-custom" target="_blank" rel="nofollow">
                                        <?= (!empty($feed->read_more_button_text)) ? esc($feed->read_more_button_text) : esc($settings->optional_url_button_name); ?>&nbsp;&nbsp;&nbsp;<i class="icon-long-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php $files = getPostFiles($post->id);
                            if (!empty($files)) : ?>
                                <div class="post-files">
                                    <h2 class="title"><?= trans("files"); ?></h2>
                                    <?php foreach ($files as $file) : ?>
                                        <form action="<?= base_url('download-file'); ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="name" value="<?= $file->file_name; ?>">
                                            <div class="file">
                                                <button type="submit"><i class="icon-file"></i><?= $file->file_name; ?></button>
                                            </div>
                                        </form>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="post-tags">
                            <?php if (!empty($postTags)) : ?>
                                <h3 class="tags-title"><?= trans("tags"); ?></h3>
                                <ul class="tag-list">
                                    <?php foreach ($postTags as $tag) : ?>
                                        <li><a href="<?= langBaseUrl('tag/' . esc($tag->tag_slug)); ?>"><?= esc($tag->tag); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="post-share">
                            <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= langBaseUrl(esc($post->title_slug)); ?>', 'Share This Post', 'width=640,height=450');return false" class="btn-share share facebook">
                                <i class="icon-facebook"></i><span class="hidden-sm">Facebook</span>
                            </a>
                            <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url=<?= langBaseUrl(esc($post->title_slug)); ?>&amp;text=<?= urlencode($post->title); ?>', 'Share This Post', 'width=640,height=450');return false" class="btn-share share twitter">
                                <i class="icon-twitter"></i><span class="hidden-sm">Twitter</span>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?= esc($post->title); ?> - <?= langBaseUrl(esc($post->title_slug)); ?>" target="_blank" class="btn-share share whatsapp">
                                <i class="icon-whatsapp"></i><span class="hidden-sm">Whatsapp</span>
                            </a>
                            <a href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?= langBaseUrl(esc($post->title_slug)); ?>', 'Share This Post', 'width=640,height=450');return false" class="btn-share share linkedin">
                                <i class="icon-linkedin"></i><span class="hidden-sm">Linkedin</span>
                            </a>
                            <a href="javascript:void(0)" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?= langBaseUrl(esc($post->title_slug)); ?>&amp;media=<?= getPostImage($post, 'mid') ?>', 'Share This Post', 'width=640,height=450');return false" class="btn-share share pinterest">
                                <i class="icon-pinterest"></i><span class="hidden-sm">Pinterest</span>
                            </a>
                        </div>

                        <?php if ($generalSettings->emoji_reactions == 1) : ?>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="reactions noselect">
                                        <h4 class="title-reactions"><?= trans("whats_your_reaction"); ?></h4>
                                        <div id="reactions_result">
                                            <?= view('partials/_emoji_reactions'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="bn-bottom-post">
                                    <?= view("partials/_ad_spaces", ["adSpace" => "post_bottom"]); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?= view('post/_post_about_author', ['postUser' => $postUser]); ?>

                    <?php if (!empty($relatedPosts)) : ?>
                        <div class="related-posts">
                            <div class="related-post-title">
                                <h4 class="title"><?= trans("related_posts"); ?></h4>
                            </div>
                            <div class="row related-posts-row">
                                <ul class="post-list">
                                    <?php foreach ($relatedPosts as $item) : ?>
                                        <li class="col-sm-4 col-xs-12 related-posts-col">
                                            <a href="<?= langBaseUrl(esc($item->title_slug)); ?>">
                                                <?= view("post/_post_image", ['postItem' => $item, 'type' => 'imageSlider']); ?>
                                            </a>
                                            <h3 class="title">
                                                <a href="<?= langBaseUrl(esc($item->title_slug)); ?>"><?= esc(limitCharacter($item->title, 70, '...')); ?></a>
                                            </h3>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>


                    <div class="col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="comment-section">
                                <?php if ($generalSettings->comment_system == 1 || !empty(trim($generalSettings->facebook_comment ?? ''))) : ?>
                                    <ul class="nav nav-tabs">
                                        <?php if ($generalSettings->comment_system == 1) : ?>
                                            <li class="active"><a data-toggle="tab" href="#comments"><?= trans("comments"); ?></a></li>
                                        <?php endif;
                                        if ($generalSettings->comment_system == 1 && !empty(trim($generalSettings->facebook_comment ?? ''))) : ?>
                                            <li><a data-toggle="tab" href="#facebook_comments"><?= trans("facebook_comments"); ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php if ($generalSettings->comment_system == 1) : ?>
                                            <div id="comments" class="tab-pane fade in active">
                                                <?= view('post/_add_comment'); ?>
                                                <div id="comment-result">
                                                    <?= view('post/_comments'); ?>
                                                </div>
                                            </div>
                                        <?php endif;
                                        if ($generalSettings->comment_system == 1 && !empty(trim($generalSettings->facebook_comment ?? ''))) : ?>
                                            <div id="facebook_comments" class="tab-pane <?= ($generalSettings->comment_system != 1) ? 'active' : 'fade'; ?>">
                                                <div class="fb-comments" data-href="<?= current_url(); ?>" data-width="100%" data-numposts="5" data-colorscheme="<?= $darkMode == 1 ? 'dark' : 'light'; ?>"></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <?= view('partials/_sidebar'); ?>
            </div>
        </div>
    </div>
</section>

<?php if (!empty(trim($generalSettings->facebook_comment ?? ''))) :
    echo $generalSettings->facebook_comment;
endif; ?>

<?php if (!empty($post->feed_id)) : ?>
    <style>
        .post-text img {
            display: none !important;
        }

        .post-content .post-summary {
            display: none !important;
        }
    </style>
<?php endif; ?>
<style>
    .layout_toc {
        width: 100%;
        clear: both;
        display: inline-block;
        padding: 10px;
        border: 1px dashed #ccc;
        margin-bottom: 2em;
    }

    .toc_title {
        display: block;
        font-weight: 700;
        text-align: center !important;
        cursor: pointer;
        margin-bottom: 0 !important;
        line-height: 30px;
        position: relative;
        background-color: #0494b1;
    }

    .toc_title:after {
        position: absolute;
        right: 20px;
        content: "";
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        top: 12px;
        line-height: 25px;
        border: solid #333;
        border-width: 0 1px 1px 0;
        -webkit-transform: rotate(-135deg);
        transform: rotate(-135deg);
        height: 12px;
        width: 12px;
        transition: .2s;
        -webkit-transition: .2s;
    }

    .toc_more {
        clear: both;
        text-align: center;
        margin: 10px 0;
        cursor: pointer;
    }

    .reactions .img-reaction {
        width: 50px;
        height: 50px;
    }

    .reactions .icon-cnt {
        display: block;
        width: 100%;
        height: 35px;
        float: left;
        position: relative;
        text-align: center;
    }

    .reaction-num-votes {
        top: 1px;
        right: 13px;
    }

    .reactions {
        margin-bottom: 0;
    }

    .about-author {
        margin-top: 0px;
    }

    .reactions .col-reaction {
        margin-bottom: 0px;
    }

    .layout_toc.hide_1 .toc_title:after {
        top: 5px;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    li {
        list-style: none;
    }

    ul {
        margin-left: -25px;
    }

    #toc {
        max-height: 200px;
        padding: 1rem;
        overflow-y: auto;
    }

    #toc a:hover {
        text-decoration: underline;
    }

    #toc .toc-active {
        font-weight: bold;
        color: #2563eb;
    }

    #toc .toc-item {
        padding: 0.1em 0;
    }

    #toc .toc-item a {
        padding: 0.25em 0.5em;
    }

    #toc .toc-h2 {
        margin-left: 0.5em;
    }

    #toc .toc-h3 {
        margin-left: 1.75em;
    }

    #toc .toc-h4 {
        margin-left: 3em;
    }

    #toc .toc-h5 {
        margin-left: 4.25em;
    }

    #toc .toc-h6 {
        margin-left: 5.5em;
    }

    .best_offer_top {
        background-color: #0494b1;
        text-align: left;
        padding: 0.6em 1em;
        color: #fff;
    }

    .best_offer {
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 20px auto;
        overflow: hidden;
    }

    .best_offer_list .item:not(:last-child) {
        border-bottom: 1px solid #ccc;
    }

    .best_offer_list .item {
        padding: 1em;
        background-color: #fdfdfd;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .best_offer_list .item .cell {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 calc(100%/3);
        flex: 0 0 calc(100%/3);
        width: calc(100%/3);
    }

    .best_offer_list .item_image {
        text-align: left;
    }

    .best_offer_list .item .cell {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 calc(100%/3);
        flex: 0 0 calc(100%/3);
        width: calc(100%/3);
    }

    .best_offer_list .item_price {
        text-align: center;
        color: black;
    }

    .ck-content.desktop .best_offer_list .item_link {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
    }

    .best_offer_list .item .cell {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 calc(100%/3);
        flex: 0 0 calc(100%/3);
        width: calc(100%/3);
    }

    .best_offer_list .item_link {
        text-align: center;
        margin: 0 auto;
    }

    .best_offer_list .item .cell * {
        margin: 0;
    }

    .best_offer_list .item_image img {
        max-height: 50px !important;
        max-width: 100px !important;
        -o-object-fit: contain !important;
        object-fit: contain !important;
        pointer-events: none;
    }

    .ck-content .img-loading-content {
        max-width: 100%;
    }

    .best_offer_list .item_image * {
        text-align: left !important;
    }

    @media (max-width: 767px) {
        .reactions .col-reaction {
            margin-right: 3.8px;
            width: 15.2%;
        }
    }
</style>
<script src="<?= base_url('assets/js/jquery-1.12.4.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $(".toc_title").click(function() {
            $(".layout_toc").toggleClass("hide_1");
            $(".toc_content").toggleClass("hide");
        });
        // Lấy tất cả các heading trong bài viết
        const headings = document.querySelectorAll('.post-text h1, .post-text h2, .post-text h3, .post-text h4, .post-text h5, .post-text h6')
        if (headings.length === 0) return

        // Khai bào nơi mà TOC sẽ được chèn vào
        const tocContainer = document.querySelector('.toc_content')

        // Xác định cấp độ bắt đầu của TOC (bởi vì không phải bài viết nào cũng có thẻ H1, hoặc H2)
        const startingLevel = headings[0].tagName[1]

        // Tạo TOC rỗng
        const toc = document.createElement('ul')

        // Theo dõi các cấp độ heading trước đó
        const prevLevels = [0, 0, 0, 0, 0, 0]

        // Lặp qua từng heading và thêm chúng vào TOC
        for (let i = 0; i < headings.length; i++) {
            const heading = headings[i]
            const level = parseInt(heading.tagName[1])

            // Tăng các cấp độ trước đó lên đến cấp độ hiện tại
            prevLevels[level - 1]++
            for (let j = level; j < prevLevels.length; j++) {
                prevLevels[j] = 0
            }

            // Tạo số mục cho mục đó dựa trên các cấp độ trước đó
            // và loại bỏ số 0 nếu trường hợp h1 -> h3 (không có h2)
            // Sẽ tạo ra các đề mục ví dụ như:
            // 1. Heading h1a
            //     1.1 Heading h2
            // 2. Heading h1b
            //          2.1 Heading h3 (đẹp hơn 2.0.1 Heading h3)
            const sectionNumber = prevLevels.slice(startingLevel - 1, level).join('.').replace(/\.0/g, "")

            // Tạo ID mới và gán vào heading
            // Phải làm phần này để click vào mục lục có thể di chuyển đến được.
            const newHeadingId = `${heading.textContent.toLowerCase().replace(/ /g, '-')}`
            heading.id = toSlug(newHeadingId)

            // Tạo liên kết mục cho heading
            const anchor = document.createElement('a')
            anchor.setAttribute('href', `#${toSlug(newHeadingId)}`)
            anchor.textContent = heading.textContent

            // Thêm event listener để cuộn đến liên kết khi nhấp chuột
            anchor.addEventListener('click', (event) => {
                event.preventDefault()
                const targetId = event.target.getAttribute('href').slice(1)
                const targetElement = document.getElementById(targetId)
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                })
                // Thêm anchor vào URL khi click
                history.pushState(null, null, `#${targetId}`)
            })

            // Tạo thẻ <li> để thêm vào TOC
            const listItem = document.createElement('li')
            listItem.textContent = sectionNumber
            listItem.appendChild(anchor)

            // Thêm CSS class cho từng mục lục
            // Ví dụ "toc-item toc-h1", "toc-item toc-h2"
            const className = `toc-${heading.tagName.toLowerCase()}`
            listItem.classList.add('toc-item')
            listItem.classList.add(className)

            // Bỏ thẻ <li> vừa tạo vào TOC
            toc.appendChild(listItem)
        }

        // Thêm các TOC item vào toc contaner
        tocContainer.innerHTML = ''
        tocContainer.appendChild(toc)
    });

    function toSlug(str) {
        // Chuyển hết sang chữ thường
        str = str.toLowerCase();

        // xóa dấu
        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        str = str.replace(/(đ)/g, 'd');

        // Xóa ký tự đặc biệt
        str = str.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        str = str.replace(/(\s+)/g, '-');

        // Xóa ký tự - liên tiếp
        str = str.replace(/-+/g, '-');

        // xóa phần dự - ở đầu
        str = str.replace(/^-+/g, '');

        // xóa phần dư - ở cuối
        str = str.replace(/-+$/g, '');

        // return
        return str;
    }
</script>