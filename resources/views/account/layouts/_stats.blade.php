<div class="container no-padding-xs">
    <div class="col-sm-12 no-padding ACCOUNT-HEADER-FOLD-CONTENT">
        <span class="hidden-xs">
            <div class="col-xs-6 col-sm-3">
            <h4>Files</h4>
            <p>{{ $fileCount }}</p>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4>Sales</h4>
                <p>{{ $saleCount }}</p>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4>Sales This Month</h4>
                <p>${{ $thisMonthEarned }}</p>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4>Lifetime Sales</h4>
                <p>${{ $lifetimeEarned }}</p>
            </div>
        </span>
        <span class="visible-xs">
            <div class="STAT-BOX">
                <p>Files: <span class="pull-right">{{ $fileCount }}</span></p>
            </div>
            <div class="STAT-BOX">
                <p>Sales: <span class="pull-right">{{ $saleCount }}</span></p>
            </div>
            <div class="STAT-BOX">
                <p>Sales This Month: <span class="pull-right">${{ $thisMonthEarned }}</span></p>
            </div>
            <div class="STAT-BOX">
                <p>Lifetime Sales: <span class="pull-right">${{ $lifetimeEarned }}</span></p>
            </div>
        </span>
    </div>
</div>