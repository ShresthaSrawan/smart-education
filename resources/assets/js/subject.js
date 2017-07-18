import Vue from 'vue';
require('./bootstrap');

new Vue({
    el: '#app',
    data: {
        subjects: [],
        grade: grade,
        new_subject: {
            name: '',
            teacher_id: null
        },
        saving: false,
        fetching: false
    },
    mounted(){
        this.fetchSubjects();
    },
    methods: {
        fetchSubjects() {
            let p = this;
            p.fetching = true;
            axios.get(`/grade/${grade}/subject/data`)
                .then(({data}) => {
                    p.subjects = data;
                    p.fetching = false;
                })
                .catch(err => {
                    console.log(err);
                    p.fetching = false;
                });
        },
        addSubject() {
            let p = this;
            p.saving = true;
            axios.post(`/grade/${grade}/subject`, this.new_subject)
                .then(({data}) => {
                    p.subjects = data.subjects;
                    p.saving = false;
                    $(document).find('#subjectModal').modal('hide');
                    $('.modal-backdrop').remove();
                })
                .catch((err) => {
                    console.log(err);
                    p.saving = false;
                });
        },
        removeSubject(subject) {
            subject.removing = true;
            axios.delete(`/grade/${grade}/subject/${subject.id}`, this.new_subject)
                .then(({data}) => {
                console.log(data);
                    p.subjects = data.subjects;
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    }
});