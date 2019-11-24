export class ComentarioServicio {
    constructor(
        public id_comentario: number,
        public id_servicio: number,
        public id_user: number,
        public comentario: string,
        public calificacion: number,
        public tipo: string,

    ){}
}