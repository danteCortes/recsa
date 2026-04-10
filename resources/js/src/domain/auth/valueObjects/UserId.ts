export class UserId {

    private constructor(private readonly _value: string){
        this._value = _value;
    }

    public static create(id: string): UserId {
        if(id.length < 5) {
            throw new Error('UserId must be at least 5 characters long');
        }
        return new UserId(id);
    }

    public value(): string {
        return this._value;
    }
}