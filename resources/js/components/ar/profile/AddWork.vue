<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>إضافة عمل جديد</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>عمل جديد</h4>
                                <div class="chosen-outer">
                                    <router-link to="/ar/profile/portfolio" class="btn btn-primary">
                                        عودة إلى معرض الأعمال
                                        <i class="fa fa-angle-left"></i>
                                    </router-link>
                                </div>
                            </div>

                            <div class="widget-content">

                                <form class="default-form">
                                    <div class="row">
                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>اسم العمل</label>
                                            <input type="text" v-model="work.title" required>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>وصف العمل</label>
                                            <textarea v-model="work.description" required></textarea>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>رابط العمل (اختياري)</label>
                                            <input type="url" v-model="work.url">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>صور العمل</label>
                                            <div class="uploading-outer">
                                                <div class="uploadButton">
                                                    <input class="uploadButton-input"
                                                           type="file"
                                                           id="upload"
                                                           ref="files"
                                                           accept="image/jpeg,image/png"
                                                           @change="uploadImages($event)"
                                                           multiple
                                                    />
                                                    <label class="uploadButton-button ripple-effect" for="upload">رفع صور</label>
                                                    <span class="uploadButton-file-name"></span>
                                                </div>
                                            </div>
                                            <div class="preview" v-if="preview.length > 0">
                                                <img v-for="img in preview" :src="img">
                                            </div>
                                            <div class="w-100 text-right p-2" v-if="preview.length > 0">
                                                <button type="button" class="btn btn-link" @click="preview = [],images = []">
                                                    حذف الصور
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Input -->
                                        <div v-if="errors.empty"
                                             class="form-group col-lg-12 col-md-6 alert alert-danger">
                                            يرجى تعبئة كل الحقول.
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12 text-right">
                                            <button class="btn btn-success"
                                                    type="button"
                                                    @click="addWork">
                                                إضافة
                                            </button>
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
    </section>
</template>

<script>
export default {
    mounted() {

    },
    data: function () {
        return {
            loading: false,
            work: {
                title: "",
                description: "",
                url: ""
            },
            images: [],
            preview: [],
            errors: {
                empty: false
            }
        }
    },
    methods: {
        addWork() {
            this.loading = true
            const fd = new FormData();

            Object.entries(this.work).forEach(([key, value]) => {
                fd.append(key, value);
            });

            for(let i = 0; i < this.images.length; i++) {
                fd.append('files[' + i + ']', this.images[i])
            }
            // console.log(fd)
            axios({
                method: "post",
                url: "/request/profile/add-portfolio",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    console.log(res.data)
                    this.images = []
                    this.preview = []
                    this.work.title = ""
                    this.work.description = ""
                    this.work.url = ""
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
                        title: 'تمت الإضافة بنجاح'
                    })
                    this.loading = false
                })
        },
        uploadImages(e) {
            let i = 0,
                j = 0,
                s = e.target.files.length
            for(i; i < s; i++) {
                this.preview.push(URL.createObjectURL(e.target.files[i]))
            }
            this.images = e.target.files
        }
    }
}
</script>

<style scoped>

</style>