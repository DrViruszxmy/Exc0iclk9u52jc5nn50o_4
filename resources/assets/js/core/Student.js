
class Student {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.info = [];
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field) {
        if (this.info) {
            for (let [key, value] of Object.entries(this.info)) {
                return value[field];
            }
        } 
        return "";
    }

    /**
     * Record the new info.
     *
     * @param {object} info
     */
    record(info) {
        this.info = info;
    }

}

export default Student;