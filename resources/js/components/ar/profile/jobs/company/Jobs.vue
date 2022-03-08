<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>إدارة الوظائف</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>وظائفي</h4>
                                <div class="chosen-outer">
                                    <router-link to="/ar/profile/jobs/add" class="btn btn-primary">
                                        إضافة وظيفة
                                    </router-link>
                                </div>
                            </div>
                            <div class="widget-content">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                        <tr>
                                            <th>عنوان الوظيفة</th>
                                            <th>المتقدمين</th>
                                            <th>التاريخ</th>
                                            <th>الحالة</th>
                                            <th>تاريخ إنتهاء الصلاحية</th>
                                            <th>خيارات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="jobs.length == 0">
                                            <td colspan="6"><p class="text-center">لا يوجد وظائف بعد.</p></td>
                                        </tr>
                                        <tr v-for="(job, index) in jobs" :key="job.id">
                                            <td>
                                                <h6><a :href="'/ar/job/' + job.id">{{ job.title }}</a></h6>
                                                <span class="mr-2">
                                                    <span class="icon flaticon-briefcase"></span> {{ job.category.name_ar }}
                                                </span>
                                                <span class="info" v-if="job.country">
                                                    <i class="icon flaticon-map-locator"></i>
                                                    {{ job.country.name }}, {{ job.city.name }}
                                                </span>
                                                <span class="info" v-else>
                                                    <span class="icon flaticon-monitor"></span>
                                                    عن بعد
                                                </span>
                                            </td>
                                            <td :class="{applied:job.applicants.length > 0}" v-if="job.applicants.length > 0">
                                                <a :href="'/ar/profile/job/'+job.id">
                                                    {{ job.applicants.length }} متقدم
                                                </a>
                                            </td>
                                            <td v-else>لا يوجد متقدمين</td>
                                            <td>{{ job.time }}</td>
                                            <td>
                                                <span v-if="job.expire != 0" class="status">فعال</span>
                                                <span v-if="job.expire == 0" class="text-danger">منتهي الصلاحية</span>
                                            </td>
                                            <td v-if="job.expire == -1">Open</td>
                                            <td v-else-if="job.expire == 0" class="text-danger">{{ job.expire_date }}</td>
                                            <td v-else>
                                                {{ job.expire_date }}
                                                <br />
                                                {{ job.expire }}
                                            </td>
                                            <td>
                                                <div class="option-box">
                                                    <ul class="option-list">
                                                        <li>
                                                            <a :href="'/ar/job/'+job.id" data-text="معاينة">
                                                                <span class="la la-eye"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a :href="'/ar/profile/job/edit/'+job.id" data-text="تعديل">
                                                                <span class="la la-pencil"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button data-text="حذف"><span
                                                                class="la la-trash"></span></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="widget-loading" v-if="loading">
                                <img src="/assets/images/loading.gif">
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
        document.title = "لوحة التحكم - الوظائف"
        // Get User
        axios.get('/request/profile/get-user-jobs')
            .then((res) => {
                if(res.data == 0) {
                    window.location.href = "/ar/dashboard"
                }
                // console.log(res.data)
                this.user = res.data
                this.jobs = res.data.jobs
                this.loading = false
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            user: "",
            jobs: [],
            loading: true
        }
    }
}
</script>

<style>
.widget-loading {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #ffffffd9;
    z-index: 9;
}
.widget-loading i {
    font-size: 36px;
    color: #333;
}
</style>
