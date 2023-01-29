<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Mein Lebenslauf</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>CV</h4>
                                <span v-if="user.cv" style="font-size: 15px;">
                                    <strong>Current CV file:</strong> {{ user.cv }}
                                    <button type="button" @click="deleteCv" class="btn btn-danger btn-sm">Delete Cv</button>
                                </span>
                            </div>

                            <div class="widget-content">
                                <form class="default-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-info" v-if="uploadingCv">
                                                Uploading...don't close this window unit finishing uploading.
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4" v-if="cv">
                                            <h6>File: {{ cv.name }} Selected.</h6>
                                            <div class="my-4">
                                                <button type="button"
                                                        class="theme-btn btn-style-seven"
                                                        @click="saveCv">
                                                    Speichern
                                                </button>
                                                <button type="button" class="btn btn-link"
                                                        @click="cv=''">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                        <div class="uploading-outer">
                                            <div class="uploadButton">
                                                <input class="uploadButton-input"
                                                       type="file"
                                                       accept="application/pdf"
                                                       @change="uploadCv($event)"
                                                       id="upload"/>
                                                <label class="uploadButton-button ripple-effect" for="upload">
                                                    Browse CV
                                                </label>
                                                <span class="uploadButton-file-name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <!-- Resume / Education -->
                                            <div class="resume-outer">
                                                <div class="upper-title">
                                                    <h4>Bildung</h4>
                                                    <button class="add-info-btn"
                                                            type="button"
                                                            @click="modals.addEdu=true">
                                                        <span class="icon flaticon-plus"></span>
                                                        Bildung hinzufügen
                                                    </button>
                                                </div>
                                                <div v-if="education.length > 0">
                                                    <div class="resume-block"
                                                         v-for="(edu, index) in education"
                                                         :key="edu.id">
                                                        <div class="inner">
                                                            <span class="name"></span>
                                                            <div class="title-box">
                                                                <div class="info-box">
                                                                    <h3> {{ edu.certificate }}
                                                                        in {{ edu.field }}</h3>
                                                                    <span>{{ edu.college }}</span>
                                                                </div>
                                                                <div class="edit-box">
                                                                    <span
                                                                        class="year">
                                                                        {{ edu.start_year }}
                                                                        {{ edu.end_year ? '- ' + edu.end_year : '' }}
                                                                    </span>
                                                                    <div class="edit-btns">
                                                                        <button type="button"
                                                                                @click="modals.editEdu=true,ed=index">
                                                                            <span class="la la-pencil"></span>
                                                                        </button>
                                                                        <button type="button"
                                                                                @click="modals.deleteEdu=true,ed=index">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text">{{ edu.description }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="text-center">
                                                    No Education yet.
                                                </div>
                                            </div>

                                            <!-- Resume / Work & Experience -->
                                            <div class="resume-outer theme-blue">
                                                <div class="upper-title">
                                                    <h4>Arbeit & Erfahrung</h4>
                                                    <button class="add-info-btn"
                                                            type="button"
                                                            @click="modals.addExp=true">
                                                        <span class="icon flaticon-plus"></span> Arbeit hinzufügen
                                                    </button>
                                                </div>
                                                <div v-if="experience.length > 0">
                                                    <div class="resume-block" v-for="(exp, index) in experience"
                                                         :key="exp.id">
                                                        <div class="inner">
                                                            <span class="name"></span>
                                                            <div class="title-box">
                                                                <div class="info-box">
                                                                    <h3>{{ exp.job_title }}</h3>
                                                                    <span>{{ exp.company }}</span>
                                                                </div>
                                                                <div class="edit-box">
                                                                <span class="year">
                                                                    {{ exp.start_year }}
                                                                        {{ exp.end_year ? '- ' + exp.end_year : '' }}
                                                                </span>
                                                                    <div class="edit-btns">
                                                                        <button type="button"
                                                                                @click="modals.editExp=true,ex=index">
                                                                            <span class="la la-pencil"></span>
                                                                        </button>
                                                                        <button type="button" @click="modals.deleteExp=true,ex=index">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text">{{ exp.description }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="text-center">
                                                    No Work Experience yet.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="widget-loading" v-if="loading">
                                <img src="/assets/images/loading.gif">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Education Modals -->
        <Modal v-model="modals.addEdu" title="Add New Education">
            <div class="form-group">
                <label>Name der Hochschule</label>
                <input type="text" class="form-control" v-model="newRecords.education.college" required>
            </div>
            <div class="form-group">
                <label>Zertifikat</label>
                <input type="text" class="form-control" v-model="newRecords.education.certificate" required>
            </div>
            <div class="form-group">
                <label>Fachrichtung</label>
                <input type="text" class="form-control" v-model="newRecords.education.field" required>
            </div>
            <div class="form-group">
                <label>Anfangsjahr</label>
                <input type="text" class="form-control" v-model="newRecords.education.start_year" required>
            </div>
            <div class="form-group">
                <label>Ende Jahr</label>
                <input type="text" class="form-control" v-model="newRecords.education.end_year" required>
            </div>
            <div class="form-group">
                <label>Beschreibung</label>
                <textarea cols="30" rows="10" class="form-control" v-model="newRecords.education.description"
                          required></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="button" @click="addEdu">Hinzufügen</button>
            </div>
        </Modal>
        <Modal v-model="modals.editEdu" title="Bearbeiten">
            <div v-if="modals.editEdu">
                <div class="form-group">
                    <label>Name der Hochschule</label>
                    <input type="text" class="form-control" v-model="education[ed].college" required>
                </div>
                <div class="form-group">
                    <label>Zertifikat</label>
                    <input type="text" class="form-control" v-model="education[ed].certificate" required>
                </div>
                <div class="form-group">
                    <label>Fachrichtung</label>
                    <input type="text" class="form-control" v-model="education[ed].field" required>
                </div>
                <div class="form-group">
                    <label>Anfangsjahr</label>
                    <input type="text" class="form-control" v-model="education[ed].start_year" required>
                </div>
                <div class="form-group">
                    <label>Ende Jahr</label>
                    <input type="text" class="form-control" v-model="education[ed].end_year" required>
                </div>
                <div class="form-group">
                    <label>Beschreibung</label>
                    <textarea cols="30" rows="10" class="form-control" v-model="education[ed].description"
                              required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="button" @click="updateEdu(ed)">Speichern</button>
                </div>
            </div>
        </Modal>
        <Modal v-model="modals.deleteEdu" title="Are you sure?">
            <div class="modal-body">
                Are you sure delete?
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" @click="deleteEdu(ed)">Yes</button>
                <button class="btn btn-secondary" @click="modals.deleteEdu=false">Cancel</button>
            </div>
        </Modal>
        <!-- Experience Modals -->
        <Modal v-model="modals.addExp" title="Add New Experience">
            <div class="form-group">
                <label>Stellen-Titel</label>
                <input type="text" class="form-control" v-model="newRecords.experience.job_title" required>
            </div>
            <div class="form-group">
                <label>Unternehmen</label>
                <input type="text" class="form-control" v-model="newRecords.experience.company" required>
            </div>
            <div class="form-group">
                <label>Anfangsjahr</label>
                <input type="text" class="form-control" v-model="newRecords.experience.start_year" required>
            </div>
            <div class="form-group">
                <label>Ende Jahr</label>
                <input type="text" class="form-control" v-model="newRecords.experience.end_year" required>
            </div>
            <div class="form-group">
                <label>Beschreibung</label>
                <textarea cols="30" rows="10" class="form-control" v-model="newRecords.experience.description"
                          required></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="button" @click="addExp">Hinzufügen</button>
            </div>
        </Modal>
        <Modal v-model="modals.editExp" title="Bearbeiten">
            <div v-if="modals.editExp">
                <div class="form-group">
                    <label>Job Titel</label>
                    <input type="text" class="form-control" v-model="experience[ex].job_title" required>
                </div>
                <div class="form-group">
                    <label>Unternehmen</label>
                    <input type="text" class="form-control" v-model="experience[ex].company" required>
                </div>
                <div class="form-group">
                    <label>Anfangsjahr</label>
                    <input type="text" class="form-control" v-model="experience[ex].start_year" required>
                </div>
                <div class="form-group">
                    <label>Ende Jahr</label>
                    <input type="text" class="form-control" v-model="experience[ex].end_year" required>
                </div>
                <div class="form-group">
                    <label>Beschreibung</label>
                    <textarea cols="30" rows="10" class="form-control" v-model="experience[ex].description"
                              required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="button" @click="updateExp(ex)">Speichern</button>
                </div>
            </div>
        </Modal>
        <Modal v-model="modals.deleteExp" title="Are you sure?">
            <div class="modal-body">
                Are you sure delete?
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" @click="deleteExp(ex)">Yes</button>
                <button class="btn btn-secondary" @click="modals.deleteExp=false">Cancel</button>
            </div>
        </Modal>

    </section>
</template>

<script>
export default {
    mounted() {
        document.title = "Dashboard - Resume"
        // Get User
        axios.get('/request/profile/get-resume')
            .then((res) => {
                this.user = res.data.user
                this.education = res.data.edu
                this.experience = res.data.exp
                this.loading = false
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            user: "",
            education: [],
            experience: [],
            modals: {
                addEdu: false,
                editEdu: false,
                deleteEdu: false,
                addExp: false,
                editExp: false,
                deleteExp: false
            },
            newRecords: {
                education: {
                    college: "",
                    certificate: "",
                    field: "",
                    start_year: "",
                    end_year: "",
                    description: "",
                },
                experience: {
                    job_title: "",
                    company: "",
                    start_year: "",
                    end_year: "",
                    description: "",
                }
            },
            loading: true,
            cv: "",
            uploadingCv: false,
        }
    },
    methods: {
        addEdu: function () {
            axios.post("/request/profile/add-education", {
                edu: this.newRecords.education
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
                        title: 'Added successfully'
                    })
                    // console.log(res.data)
                    this.education.unshift(res.data)
                    this.newRecords.education.college = ""
                    this.newRecords.education.certificate = ""
                    this.newRecords.education.field = ""
                    this.newRecords.education.start_year = ""
                    this.newRecords.education.end_year = ""
                    this.newRecords.education.description = ""
                    this.modals.addEdu = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        updateEdu: function (index) {
            axios.post("/request/profile/update-education", {
                edu: this.education[index]
            })
                .then((res) => {
                    this.modals.editEdu = false
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
                        title: 'Saved successfully'
                    })
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        deleteEdu: function (index) {
            axios.post("/request/profile/delete-education", {
                id: this.education[index].id
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
                    this.education.splice(index, 1)
                    this.modals.deleteEdu = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        addExp: function () {
            axios.post("/request/profile/add-experience", {
                exp: this.newRecords.experience
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
                        title: 'Added successfully'
                    })
                    // console.log(res.data)
                    this.experience.unshift(res.data)
                    this.newRecords.experience.job_title = ""
                    this.newRecords.experience.company = ""
                    this.newRecords.experience.start_year = ""
                    this.newRecords.experience.end_year = ""
                    this.newRecords.experience.description = ""
                    this.modals.addExp = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        updateExp: function (index) {
            axios.post("/request/profile/update-experience", {
                exp: this.experience[index]
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
                        title: 'Saved successfully'
                    })
                    this.modals.editExp = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        deleteExp: function (index) {
            axios.post("/request/profile/delete-experience", {
                id: this.experience[index].id
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
                    this.experience.splice(index, 1)
                    this.modals.deleteExp = false
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        uploadCv: function (e) {
            this.cv = e.target.files[0]
        },
        saveCv: function () {
            this.uploadingCv = true
            const fd = new FormData();
            fd.append('cv',this.cv)
            axios({
                method: "post",
                url: "/request/profile/update-cv",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
            .then((res) => {
                if(res.data === 1) {
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
                        title: 'Saved successfully'
                    })
                    this.cv = ""
                    this.uploadingCv = false
                }
            })
        },
        deleteCv: function () {
            axios.post("/request/profile/delete-cv")
            .then((res) => {
                if(res.data == 1) {
                    this.user.cv = ""
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
                }
            })
        }
    }
}
</script>

<style>

</style>
