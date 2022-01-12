<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Portfolio</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>My portfolio</h4>
                                <span>
                                    <a href="/profile/portfolio/add" class="btn btn-primary">
                                        Add New Work
                                    </a>
                                </span>
                            </div>
                            <div class="widget-content">
                                <form class="default-form">
                                    <div class="row" v-if="portfolio.length > 0">
                                        <div class="col-12 col-md-3 mt-3"
                                             v-for="(port, index) in portfolio"
                                             :key="port.id">
                                            <img :src="'/images/portfolio/' + port.portfolio_images[0].image"
                                                 class="w-100 shadow"
                                                 style="height: 280px;border-radius: 7px">
                                            <h5 class="my-3 pl-2">{{ stringCut(port.title) }}</h5>
                                            <div class="my-2 pl-2">
                                                <div class="btn-group">
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            @click="modals.delete=true,x=index">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-else>
                                        <div class="col-12">
                                            <p class="text-center">No Works added yet.</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay" v-if="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </div>
        <Modal v-model="modals.delete" title="Are you sure?">
            <div class="modal-body">
                Are you sure delete?
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" @click="deletePortfolio(x)">Yes</button>
                <button class="btn btn-secondary" @click="modals.delete=false">Cancel</button>
            </div>
        </Modal>
    </section>
</template>

<script>
export default {
    mounted() {
        document.title = "Dashboard - Portfolio"
        axios.get("/request/profile/get-portfolio")
        .then((res) => {
            this.portfolio = res.data.user_portfolio
            console.log(res.data)
        })
    },
    data: function () {
        return {
            images: [],
            preview: [],
            portfolio: [],
            loading: false,
            modals: {
                delete: false
            },
            isLoading: false,
            fullPage: true
        }
    },
    methods: {
        deletePortfolio: function (index) {
            axios.post("/request/profile/delete-portfolio", {
                id: this.portfolio[index].id
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
                    title: 'Deleted successfully'
                })
                this.portfolio.splice(index, 1)
                this.modals.delete = false
            })
        },
        stringCut(s) {
            return s.length > 20 ? s.substr(0, 20) + "..." : s;
        }
    }
}
</script>

<style>
.preview img {
    width: 120px;
    height: 120px;
    margin: 12px;
    border-radius: 5px;
}
.overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
}
.overlay i {
    color: #fff;
    font-size: 40px;
}
</style>
