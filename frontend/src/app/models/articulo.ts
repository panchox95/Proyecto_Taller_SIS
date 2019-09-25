export class Articulo {
    constructor(
        public id_articulo: number,
        public title: string,
        public description: string,
        public price: number,
        public status: string,
        public createdAt: any,
        public updatedAt: any
    ){}
}