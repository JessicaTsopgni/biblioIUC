export class CategoryModel
{
    status_name:string;
    constructor
    (
        public id:number,
        public name:string,
        public description:string,
        public category_parent_id:string,
        public category_parent:CategoryModel,
        public image:File,
        public image_link:string,
        public status:boolean
    ){
        this.setStatusName();
    }
    setStatusName () {
        this.status_name = !this.status ? 'Activé':'Désactivé';
    }
}