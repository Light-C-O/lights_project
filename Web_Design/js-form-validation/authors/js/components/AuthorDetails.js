class  AuthorDetails{
    constructor(_test){
        this.test = _test;
    }
    render(){
        let test = document.querySelector('#test');
        test = "http://localhost/intProj/lights_project/My_project/etc/";

        let authorDetail = document.createElement('div');

        authorDetail.setAttribute('class', 'authorDetail');

        authorDetail.innerHTML = `
        <div class="some">
            <a href= "edit_navbar.php">Go Back</a>
        </div>
        `;

        return authorDetail;
    }
}
export default AuthorDetails;