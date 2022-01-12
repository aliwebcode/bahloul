<template>
    <div>
        <section class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3></h3>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="left">
                                <i class=""></i>
                            </div>
                            <div class="right">
                                <h4></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-red">
                            <div class="left">
                                <i class=""></i>
                            </div>
                            <div class="right">
                                <h4></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-yellow">
                            <div class="left">
                                <i class=""></i>
                            </div>
                            <div class="right">
                                <h4></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="left">
                                <i class=""></i>
                            </div>
                            <div class="right">
                                <h4></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-7">
                        <!-- Graph widget -->
                        <div class="graph-widget ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4></h4>
                                    <div class="chosen-outer">
                                        <a href=""></a>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="row">
                                        <div class="candidate-block-three col-md-12"
                                             style="margin-bottom: 10px;">
                                            <div class="inner-box" style="padding: 15px">
                                                <div class="content">
                                                    <figure class="image">
                                                        <img src="">
                                                    </figure>
                                                    <h4 class="name">
                                                        <a href=""></a>
                                                    </h4>
                                                    <ul class="candidate-info">
                                                        <li>

                                                        </li>
                                                        <li>

                                                        </li>
                                                        <li>

                                                        </li>
                                                    </ul>
                                                    <ul class="post-tags">
                                                        <li class="time"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!-- Notification Widget -->
                        <div class="notification-widget ls-widget">
                            <div class="widget-title">
                                <h4></h4>
                                <div class="chosen-outer">
                                    <a href="/"></a>
                                </div>
                            </div>
                            <div class="widget-content">
                                <ul class="notification-list">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
name: "Dashboard"
}
</script>

<style scoped>
.upper-title-box h3 {
    animation: pulse-bg 1s infinite;
    width: 200px;
    height: 30px;
}
.ui-item .left i {
    display: block;
    width: 60px;
    height: 60px;
    animation: pulse-bg 1s infinite;
    border-radius: 7px;
}
.ui-item .right h4 {
    width: 30px;
    height: 30px;
    animation: pulse-bg 1s infinite;
    margin-left: auto;
}
.ui-item .right p {
    width: 70px;
    height: 30px;
    animation: pulse-bg 1s infinite;
}

.widget-title h4 {
    width: 100px;
    height: 30px;
    animation: pulse-bg 1s infinite;
}
.chosen-outer a {
    width: 60px;
    height: 20px;
    animation: pulse-bg 1s infinite;
}
.widget-content .inner-box figure {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    animation: pulse-bg 1s infinite;
}
.widget-content .inner-box h4 {
    width: 100px;
    height: 20px;
    animation: pulse-bg 1s infinite;
}
.widget-content .inner-box ul li {
    margin-top: 10px;
    width: 80px;
    height: 20px;
    animation: pulse-bg 1s infinite;
}
.notification-list li {
    width: 100%;
    min-height: 30px;
    margin-bottom: 10px;
    animation: pulse-bg 1s infinite;
}

@keyframes pulse-bg {
    0% {
        background-color: #eee;
    }
    50% {
        background-color: #e8e8e8;
    }
    100% {
        background-color: #eee;
    }
}

</style>