<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>{{ job.title }} - All Aplicants</h3>
                <div class="text">Ready to jump back in?</div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Applicant</h4>
                                <div class="chosen-outer">
                                    <a href="/profile/jobs" class="btn btn-primary">
                                        Back To Jobs
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-content">

                                <div class="tabs-box">
                                    <div class="aplicants-upper-bar">
                                        <h6>{{ job.title }}</h6>
                                        <!--                                        <ul class="aplicantion-status tab-buttons clearfix">-->
                                        <!--                                            <li class="tab-btn active-btn totals" data-tab="#totals">Total(s): 6</li>-->
                                        <!--                                            <li class="tab-btn approved" data-tab="#approved">Approved: 2</li>-->
                                        <!--                                            <li class="tab-btn rejected" data-tab="#rejected">Rejected(s): 4</li>-->
                                        <!--                                        </ul>-->
                                    </div>

                                    <div class="tabs-content">
                                        <!--Tab-->
                                        <div class="tab active-tab" id="totals" v-if="applicants.length > 0">
                                            <div class="row">
                                                <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12"
                                                     v-for="(applicant,index) in applicants"
                                                     :key="applicant.id">
                                                    <div class="inner-box">
                                                        <div class="content">
                                                            <figure class="image">
                                                                <img :src="'/images/users/' + applicant.user.image" v-if="applicant.user.image">
                                                                <img src="/assets/images/default_avatar.png" v-else>
                                                            </figure>
                                                            <h4 class="name">
                                                                <a :href="'/u/'+applicant.user.username">{{ applicant.user.name }}</a>
                                                            </h4>
                                                            <ul class="candidate-info">
                                                                <li class="designation">{{ applicant.user.job_title }}</li>
                                                                <li v-if="applicant.user.category">
                                                                    <span class="icon flaticon-briefcase"></span>
                                                                    {{ applicant.user.category.name }}
                                                                </li>
                                                                <li v-if="applicant.user.country">
                                                                    <span class="icon flaticon-map-locator"></span>
                                                                    {{ applicant.user.country.name }}, {{ applicant.user.city.name }}
                                                                </li>
                                                            </ul>
                                                            <ul class="post-tags">
                                                                <li><a href="#">App</a></li>
                                                                <li><a href="#">Design</a></li>
                                                                <li><a href="#">Digital</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="option-box">
                                                            <ul class="option-list">
                                                                <li>
                                                                    <a :href="'/u/'+applicant.user.username" data-text="View Aplication">
                                                                        <span class="la la-eye"></span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <button data-text="Approve Aplication"><span
                                                                        class="la la-check"></span></button>
                                                                </li>
                                                                <li>
                                                                    <button data-text="Reject Aplication"><span
                                                                        class="la la-times-circle"></span></button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div v-else><p class="text-center">No Applicants yet.</p></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    mounted() {
        document.title = "Dashboard - Applicants"
        let job_id = this.$route.params.id
        axios.get("/request/profile/get-applicants/" + job_id)
            .then((res) => {
                console.log(res.data)
                this.job = res.data
                this.applicants = res.data.applicants
                // let i = 0
                // this.job = res.data[0].job
                // for (i; i x< res.data.length; i++) {
                //     this.users.push(res.data[i].user)
                // }
            })
    },
    data: function () {
        return {
            job: "",
            applicants: []
        }
    }
}
</script>

<style scoped>

</style>
