export default {
    props: {
        endpoint: {
            type: String
        },
        sendAs: {
            type: String,
            default: 'file'
        }
    },
    data () {
        return {
            uploading: false
        }
    },
    methods: {
        upload (e) {

            this.uploading = true;

            return axios.post(this.endpoint, this.packageUploads(e)).then((response) => {
                this.uploading = false;
                return Promise.resolve(response)
            }).catch((error) => {
                this.uploading = false;
                return Promise.reject(error)
            })
        },
        packageUploads (e) {

            let fileData = new FormData();

            fileData.append(this.sendAs, e.target.files[0]);

            return fileData
        }
    }
}