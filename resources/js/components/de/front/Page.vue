<template>
    <div>
        <!--Page Title-->
        <section class="page-title">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>{{ page.name }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/">Startseite</a></li>
                        <li>{{ page.name }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div v-html="page.body"></div>
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
                    document.title = "Bahloul - " + this.page.name
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