<script>
export default {
    props: ['schools', 'male', 'female', 'ischangelog', 'changelogattribute'],
    extends: VueChartJs.Bar,
    watch: {
        schools() {
            let schools = this.schools;
            let male = this.male;
            let female = this.female;
            
            this.createChart(schools, male, female);
        },
        changelogattribute() {
            let schools = '';
            let male = '';
            let female = '';
            let ischangelog = this.ischangelog;
            let changelogattribute = this.changelogattribute;
            this.createChart(schools, male, female, changelogattribute);
        }
    },
    methods: {
        createChart(schools = '', male = '', female = '', changelogattribute = {}) {
            let ischangelog = this.ischangelog;
            if (!ischangelog) {
                return this.renderChart({
                    labels: schools,
                        datasets: [
                            {
                                label: 'Male',
                                backgroundColor: '#0d8db7',
                                data: male
                            },
                            {
                                label: 'Female',
                                backgroundColor: '#f87979',
                                data: female
                            }
                        ]
                }, {responsive: true, maintainAspectRatio: false})
                // console.log(chart);
                // document.getElementById("printChart").addEventListener("click",function(){
                //     // alert();
                //     // console.log(chart);
                //     this.renderChart.print();
                // });  
            } else {
                return this.renderChart({
                    labels: changelogattribute.subjects,
                        datasets: [
                            {
                                label: 'Drop',
                                backgroundColor: '#f87979',
                                data: changelogattribute.drop
                            },
                            {
                                label: 'Add',
                                backgroundColor: '#0b8fbc',
                                data: changelogattribute.add
                            },
                            {
                                label: 'Change',
                                backgroundColor: '#ffc41d',
                                data: changelogattribute.change
                            }
                        ]
                }, {responsive: true, maintainAspectRatio: false})
            }
            
        }, 
    },
}
</script>
