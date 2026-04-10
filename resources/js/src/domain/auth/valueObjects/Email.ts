export class Email {

    private constructor(private readonly _value: string) {
        this._value = _value;
    }

    public static create(value: string): Email {
        if (!this.isValidEmail(value)) {
            throw new Error('Invalid email address');
        }
        return new Email(value);
    }

    private static isValidEmail(email: string): boolean {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    public value(): string {
        return this._value;
    }
}