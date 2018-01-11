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
                console.log('Hit axios post request with success');
                this.uploading = false;
                return Promise.resolve(response)
            }).catch((error) => {
                this.uploading = false;
                console.log('Hit axios post request with error');
                console.log(error);
                return Promise.reject(error)
            })
        },
        packageUploads(e) {

            var fileData = new FormData();

            console.log(fileData);
            console.log(this.sendAs);
            console.log(e.target.files[0]);

            fileData.append(this.sendAs, e.target.files[0]);

            return fileData
        }
    }
}