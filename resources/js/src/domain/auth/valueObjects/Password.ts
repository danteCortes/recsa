export class Password {
    private constructor(private readonly _value: string) {
        this._value = _value;
    }

    public static create(value: string): Password {
        if (!this.isValidPassword(value)) {
            throw new Error('Invalid password. Password must be at least 6 characters long.');
        }
        return new Password(value);
    }

    private static isValidPassword(password: string): boolean {
        const passwordRegex = /^.{6,}$/;
        return passwordRegex.test(password);
    }

    public value(): string {
        return this._value;
    }
}