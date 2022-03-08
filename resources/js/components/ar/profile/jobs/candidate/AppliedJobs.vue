<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>وظائف تقدمت عليها</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>وظائف تقدمت عليها</h4>
                            </div>

                            <div class="widget-content">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                        <tr>
                                            <th>الوظيفة</th>
                                            <th>تاريخ التقديم</th>
                                            <th>الحالة</th>
                                            <th>خيارات</th>
                                        </tr>
                                        </thead>

                                        <tbody v-if="user.applicants && user.applicants.length > 0">
                                        <tr v-for="(applicant,index) in user.applicants" :key="applicant.id">
                                            <td>
                                                <!-- Job Block -->
                                                <div class="job-block">
                                                    <div class="inner-box">
                                                        <div class="content">
                                                            <span class="company-logo">
                                                                <img :src="'/images/users/' + applicant.job.user.image">
                                                            </span>
                                                            <h4>
                                                                <a :href="'/ar/job/'+applicant.job.id">
                                                                    {{ applicant.job ? applicant.job.title : '' }}
                                                                </a>
                                                            </h4>
                                                            <ul class="job-info">
                                                                <li>
                                                                    <a :href="'/ar/u/'+applicant.job.user.username">
                                                                        <span class="icon flaticon-user-1"></span>
                                                                        {{ applicant.job.user.name }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <span class="icon flaticon-briefcase"></span>
                                                                    {{ applicant.job.category.name_ar }}
                                                                </li>
                                                                <li v-if="applicant.job.country">
                                                                    <span class="icon flaticon-map-locator"></span>
                                                                    {{ applicant.job.city.name }},
                                                                    {{ applicant.job.country.name }}
                                                                </li>
                                                                <li v-if="applicant.job.type === 'Freelance'">
                                                                    <span class="icon flaticon-monitor"></span>
                                                                    Remotely
                                                                </li>
                                                            </ul>
                                                            <ul class="job-other-info mt-2">
                                                                <li class="time">{{ applicant.job.type }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ applicant.time }}</td>
                                            <td class="status">
                                                <span v-if="applicant.job.expire == 0" class="text-danger">منتهي الصلاحية</span>
                                                <span v-else class="status">فعال</span>
                                            </td>
                                            <td>
                                                <div class="option-box">
                                                    <ul class="option-list">
                                                        <li>
                                                            <button data-text="حذف"
                                                                    @click="deleteModal=true,i=index">
                                                                <span class="la la-trash"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                <p class="text-center">لا يوجد تقديم بعد.</p>
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
        <Modal v-model="deleteModal" title="هل أنت متأكد؟">
            <div class="modal-body">
                هل أنت متأكد من حذف التقديم؟
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" @click="deleteApplicant(i)">حذف</button>
                <button class="btn btn-secondary" @click="deleteModal=false">إلغاء</button>
            </div>
        </Modal>
    </section>
</template>

<script>
export default {
    mounted() {
        document.title = "لوحة التحكم - وظائف تقدمت عليها"
        axios.get("/request/profile/get-applied-jobs")
            .then((res) => {
                this.user = res.data
                this.loading = false
            })
    },
    data: function () {
        return {
            user: "",
            deleteModal: false,
            loading: true
        }
    },
    methods: {
        deleteApplicant: function (i) {
            axios.post("/request/profile/delete-applicant", {
                id: this.user.applicants[i].id
            })
                .then((res) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'تم الحذف بنجاح'
                    })
                    this.user.applicants.splice(i, 1)
                    this.deleteModal = false
                })
        }
    }
}
</script>

<style scoped>
.company-logo img {
    border-radius: 50%;
}
</style>
