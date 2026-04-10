export class Name {

    private constructor(private readonly _value: string){
        this._value = _value;
    }

    public static create(name: string): Name {
        if(name.length < 2) {
            throw new Error('Name must be at least 2 characters long');
        }
        return new Name(name);
    }

    public value(): string {
        return this._value;
    }
}