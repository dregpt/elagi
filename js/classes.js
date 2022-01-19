class ElagiSession{
    constructor(
        //Define properties:
        name,
        code,
        duration,
        price
    ) {
        // Define parameters:
        this.name=name,
            this.code=code,
            this.duration=duration
        this.price=price
    }
    changePrice(money){
        this.price=money;
    }
}


// export default ElagiSession;