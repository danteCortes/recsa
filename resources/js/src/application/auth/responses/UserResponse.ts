export class UserResponse {

    private constructor(
        public readonly id: string | null,
        public readonly name: string,
        public readonly email: string,
    ){}

    public static create(id: string | null, name: string, email: string): UserResponse {
        return new UserResponse(id, name, email);
    }
}