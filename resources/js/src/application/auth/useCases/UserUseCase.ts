import { AuthRepository } from "@/domain/auth/repositories/AuthRepository";
import { UserResponse } from "../responses/UserResponse";

export class UserUseCase {

    private constructor(private readonly repository: AuthRepository) {}

    public static create(repository: AuthRepository): UserUseCase {
        return new UserUseCase(repository);
    }

    public async execute(): Promise<UserResponse | null> {
        const entity = await this.repository.user();

        if (!entity) {
            return null;
        }

        console.log(entity);
        
        const id = entity.id();
        return UserResponse.create(
            id ? id.value() : null,
            entity.name().value(),
            entity.email().value()
        );
    }
}