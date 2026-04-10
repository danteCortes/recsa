import { AuthRepository } from "@/domain/auth/repositories/AuthRepository";
import { LoginDTO } from "../dtos/LoginDTO";
import { UserResponse } from "../responses/UserResponse";
import { Credentials } from "@/domain/auth/entities/Credentials";
import { Email } from "@/domain/auth/valueObjects/Email";
import { Password } from "@/domain/auth/valueObjects/Password";
import { RememberMe } from "@/domain/auth/enums/RememberMe";

export class LoginUseCase {
    
    private constructor(private readonly repository: AuthRepository){
        this.repository = repository;
    }

    public static create(repository: AuthRepository): LoginUseCase {
        return new LoginUseCase(repository);
    }

    public async execute(dto: LoginDTO): Promise<UserResponse> {
        const entity = await this.repository.login(
            Credentials.create(
                Email.create(dto.email),
                Password.create(dto.password),
                dto.rememberMe ? RememberMe.YES : RememberMe.NO
            )
        );

        const id = entity.id();
        return UserResponse.create(
            id ? id.value() : null,
            entity.name().value(),
            entity.email().value()
        );
    }
}