export class ComentarioProducto {
    constructor(
        public id_comentario: number,
        public id_producto: number,
        public id_user: number,
        public comentario: string,
        public calificacion: number,
        public tipo: string,

    ){}
}