import { AuthRepository } from "@/domain/auth/repositories/AuthRepository";

export class LogoutUseCase {

    private constructor(private readonly repository: AuthRepository){}

    public static create(repository: AuthRepository): LogoutUseCase {
        return new LogoutUseCase(repository);
    }

    public async execute(): Promise<void> {
        await this.repository.logout();
    }
}