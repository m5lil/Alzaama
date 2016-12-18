<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    القائمة
                </div>
                    <ul class="nav nav-pills nav-stacked">
                      <li><a href="admin/?view=posts">المقالات</a></li>
                      <li><a href="admin/?view=page">الصفحات</a></li>
                      <?php
                        if(User::theUser()->privilage == "Admin"){
                            echo' 
                                <li><a href="admin/?view=users">الإعضاء</a></li>
                                <li><a href="admin/?view=e3lan">الينرات</a></li>
                                <li><a href="admin/">الإعدادت</a></li>
                                <li><a href="admin/?view=cat">الأقسام</a></li>
                                <li><a href="admin/?view=slider">السلايدر</a></li>
                                <li><a href="admin/?view=accor">السلايدر الجانبى</a></li>
                                <li><a href="admin/?view=menu">القائمة العليا</a></li>
                                <li><a href="admin/?view=monasba">ركن المناسبات</a></li>
                            ';} 
                      ?>
                      <li><a href="admin/?view=video">الفيديو</a></li>
                      <li><a href="admin/?view=sound">الصوتيات</a></li>
                      <li><a href="admin/?view=gallary">معرض الصور</a></li>
                      <li><a href="admin/?view=email">إستفسارات الزوار</a></li>
                    </ul>  
            </div>
        </div>
        <div class="col-sm-9 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: left;">
                    <a href="javascript:history.back()"><span class="glyphicon glyphicon-chevron-left"></span></a> 
                    <a href="/"><span class="glyphicon glyphicon-home"></span></a> 
                    <a href="/"><span class="glyphicon glyphicon-cog"></span></a>  
                    <a href="/"><span class="glyphicon glyphicon-off"></span></a>
                </div>
                <div class="panel-body">                    
                    <?php $this->renderView(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    margin: 40px;
}
#accordion .glyphicon {
    margin-right: 10px;
}
.panel-collapse > .list-group .list-group-item:first-child {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
}
.panel-collapse > .list-group .list-group-item {
    border-width: 1px 0;
}
.panel-collapse > .list-group {
    margin-bottom: 0;
}
.panel-collapse .list-group-item {
    border-radius: 0;
}
.panel-collapse .list-group .list-group {
    margin: 0;
    margin-top: 10px;
}
.panel-collapse .list-group-item li.list-group-item {
    margin: 0 -15px;
    border-top: 1px solid #ddd;
    border-bottom: 0;
    padding-left: 30px;
}
.panel-collapse .list-group-item li.list-group-item:last-child {
    padding-bottom: 0;
}
.panel-collapse div.list-group div.list-group {
    margin: 0;
}
.panel-collapse div.list-group .list-group a.list-group-item {
    border-top: 1px solid #ddd;
    border-bottom: 0;
    padding-left: 30px;
}
</style>
<!-- Accordion - END -->

</div>
