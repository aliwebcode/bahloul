<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Shortlists</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>My Favorite Items</h4>
                            </div>

                            <div class="widget-content">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Date Shortlisted</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr v-if="shortlists.length == 0">
                                            <td colspan="4"><p class="text-center">No Shortlists added yet.</p></td>
                                        </tr>
                                        <tr v-for="(short, index) in shortlists" :key="short.id">
                                            <td>
                                                <!-- Job Block -->
                                                <div class="job-block">
                                                    <div class="inner-box">
                                                        <div class="content">

                                                            <span class="company-logo" v-if="short.type == 'job'">
                                                                <img :src="'/images/users/' + short.job.user.image"
                                                                     v-if="short.job.user.image">
                                                                <img src="/assets/images/default_avatar.png" v-else>
                                                            </span>

                                                            <span class="company-logo" v-if="short.type == 'resume'">
                                                                <img
                                                                    v-if="short.resume.image"
                                                                    :src="'/images/users/' + short.resume.image">
                                                                <img src="/assets/images/default_avatar.png" v-else>
                                                            </span>

                                                            <span class="company-logo" v-if="short.type == 'company'">
                                                                <img
                                                                    v-if="short.company.image"
                                                                    :src="'/images/users/' + short.company.image">
                                                                <img src="/assets/images/default_avatar.png" v-else>
                                                            </span>

                                                            <span class="company-logo" v-if="short.type == 'business'">
                                                                <img
                                                                    v-if="short.business.image"
                                                                    :src="'/images/users/' + short.business.image">
                                                                <img src="/assets/images/default_avatar.png" v-else>
                                                            </span>

                                                            <h4>
                                                                <a :href="'/job/'+short.job.id" v-if="short.type == 'job'">{{ short.job.title }}</a>
                                                                <a :href="'/u/'+short.resume.username" v-if="short.type == 'resume'">{{ short.resume.name }}</a>
                                                                <a :href="'/u/'+short.company.username" v-if="short.type == 'company'">{{ short.company.name }}</a>
                                                                <a :href="'/u/'+short.business.username" v-if="short.type == 'business'">{{ short.business.b_name }}</a>
                                                            </h4>
                                                            <ul class="job-info" v-if="short.type == 'job'">
                                                                <li v-if="short.job.user">
                                                                    <a :href="'/u/' + short.job.user.username">
                                                                        <span class="icon flaticon-user-1"></span>
                                                                        {{ short.job.user.name }}
                                                                    </a>
                                                                </li>
                                                                <li v-if="short.job.category">
                                                                    <span class="icon flaticon-briefcase"></span>
                                                                    {{ short.job.category.name }}
                                                                </li>
                                                                <li v-if="short.job.country">
                                                                    <span class="icon flaticon-map-locator"></span>
                                                                    {{ short.job.city.name }}, {{ short.job.country.name }}
                                                                </li>
                                                            </ul>
                                                            <ul class="job-info" v-if="short.type == 'resume'">
                                                                <li v-if="short.resume.category">
                                                                    <span class="icon flaticon-briefcase"></span>
                                                                    {{ short.resume.category.name }}
                                                                </li>
                                                                <li v-if="short.resume.city">
                                                                    <span class="icon flaticon-map-locator"></span>
                                                                    {{ short.resume.city.name }}, {{ short.resume.country.name }}
                                                                </li>
                                                            </ul>
                                                            <ul class="job-info" v-if="short.type == 'company'">
                                                                <li v-if="short.company.city">
                                                                    <span class="icon flaticon-map-locator"></span>
                                                                    {{ short.company.city.name }}, {{ short.company.country.name }}
                                                                </li>
                                                            </ul>
                                                            <ul class="job-info" v-if="short.type == 'business'">
                                                                <li v-if="short.business.category">
                                                                    <span class="icon flaticon-briefcase"></span>
                                                                    {{ short.business.category.name }}
                                                                </li>
                                                                <li v-if="short.business.city">
                                                                    <span class="icon flaticon-map-locator"></span>
                                                                    {{ short.business.city.name }}, {{ short.business.country.name }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button"
                                                        class="sh-type"
                                                        style="text-transform:capitalize;">{{ short.type }}
                                                </button>
                                            </td>
                                            <td>{{ short.time }}</td>
                                            <td>
                                                <div class="option-box">
                                                    <ul class="option-list" v-if="short.type == 'job'">
                                                        <li>
                                                            <a :href="'/job/' + short.job.id" data-text="View Job">
                                                                <span class="la la-eye"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button data-text="Delete Shortlist" @click="deleteModal=true,i=index">
                                                                <span class="la la-trash"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <ul class="option-list" v-if="short.type == 'resume'">
                                                        <li>
                                                            <a :href="'/u/' + short.resume.username" data-text="View Job">
                                                                <span class="la la-eye"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button data-text="Delete Shortlist" @click="deleteModal=true,i=index">
                                                                <span class="la la-trash"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <ul class="option-list" v-if="short.type == 'company'">
                                                        <li>
                                                            <a :href="'/u/' + short.company.username" data-text="View Job">
                                                                <span class="la la-eye"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button data-text="Delete Shortlist" @click="deleteModal=true,i=index">
                                                                <span class="la la-trash"></span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <ul class="option-list" v-if="short.type == 'business'">
                                                        <li>
                                                            <a :href="'/u/' + short.business.username" data-text="View Job">
                                                                <span class="la la-eye"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button data-text="Delete Shortlist" @click="deleteModal=true,i=index">
                                                                <span class="la la-trash"></span>
                                                            </button>
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
        <Modal v-model="deleteModal" title="Are you sure?">
            <div class="modal-body">
                Are you sure delete shortlist?
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" @click="deleteShortlist(i)">Yes</button>
                <button class="btn btn-secondary" @click="deleteModal=false">Cancel</button>
            </div>
        </Modal>
    </section>
</template>

<script>
export default {
    mounted() {
        document.title = "Profile - Shortlists"
        axios.get("/request/profile/get-shortlists")
        .then((res) => {
            console.log(res.data)
            this.shortlists = res.data
            this.loading= false
        })
        .catch((err) => {
            console.log(err)
        })
    },
    data: function () {
        return {
            shortlists: [],
            deleteModal: false,
            loading: true
        }
    },
    methods: {
        deleteShortlist: function (index) {
            axios.post("/request/profile/delete-shortlist", {
                id: this.shortlists[index].id
            })
            .then((res) => {
                console.log(res.data)
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
                    title: 'Deleted successfully'
                })
                this.deleteModal = false
                this.shortlists.splice(index, 1)
            })
        }
    }
}
</script>

<style scoped>
.company-logo img {
    border-radius: 50%;
}
.sh-type {
    position: relative;
    font-size: 13px;
    line-height: 15px;
    margin-right: 15px;
    padding: 5px 20px;
    border-radius: 50px;
    margin-bottom: 10px;
    background: rgba(25,103,210,.15);
    color: #1967D2;
}
</style>