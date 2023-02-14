<template>
    <div>
        <!--Page Title-->
        <section class="page-title">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>{{ page.name_ar }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/ar">الرئيسية</a></li>
                        <li>{{ page.name_ar }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div v-html="page.body_ar"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    mounted() {
        let slug = this.$route.params.slug
        axios.get("/request/front/get-page/" + slug)
            .then((res) => {
                if(res.data == 0) {
                    window.location.href = "/not-found"
                } else {
                    this.page = res.data
                    document.title = "بهلول - " + this.page.name_ar
                }
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            page: {}
        }
    }
}
</script>

<style scoped>

</style>